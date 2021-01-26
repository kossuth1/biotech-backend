<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Locale;
use App\Http\Requests\UploadImageRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Arr;;

use App\Models\ProductTag;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locales = Locale::all();
        return view('admin.products.create', ['locales' => $locales]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());
        $product->images()->createMany($request->images ?? []);

        return success(route('products.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $locales = Locale::all();
        return view('admin.products.edit', ['product' => $product, 'locales' => $locales]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $imagesToDelete = $product->images()->find($request->delete) ?: [];

        foreach ($imagesToDelete as $image) {
            $image->delete();
        }

        $tags = $request->tags ?? [];

        $tagIds = Arr::flatten($tags) ?? [];
        foreach ($product->tags as $tag) {
            if (!in_array($tag->id, $tagIds)) {
                $tag->delete();
            }
        }


        foreach ($tags as $tag) {
            $tagId = Arr::flatten($tag)[0];
            if (is_numeric($tagId)) {
                $tag = ProductTag::find($tagId);
                $tag->product()->associate($product);
            } else {
                $product->tags()->create($tag);
            }
        }

        $product->images()->createMany($request->images ?? []);
        $product->update($request->validated());
        return success(route('products.edit', $product->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response('', 200);
    }

    public function uploadImage(UploadImageRequest $request)
    {
        $image = $request->validated()['file'] ?? null;
        $path = $image->store('public/products');
        $segments = explode('/', $path);
        $fileName = end($segments);

        return response()->json(['filename' => $fileName]);
    }

    public function getProductsTableData()
    {
        return datatables()
            ->of(Product::with(['images', 'tags'])->get())
            ->editColumn('actions', function ($product) {
                return '
                    <div class="d-flex justify-content-around">                        
                        <a href="' . route('products.edit', $product->id) . '" title="Szerkesztés" data-id="' . $product->id . '">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="javascript:void(0)"title="Törlés" data-url="' . route('products.destroy', $product->id) . '" js-delete-product>
                            <i class="fas fa-times"></i>
                        </a>
                    </div>';
            })
            ->editColumn('name', function ($row) {
                return $row->translate('hu')->name;
            })
            ->editColumn('public_from', function ($row) {
                return date('Y-m-d H:i', strtotime($row->public_from));
            })
            ->editColumn('public_to', function ($row) {
                return date('Y-m-d H:i', strtotime($row->public_to));
            })
            ->editColumn('tags', function ($row) {
                return $row->tags->pluck('name')->implode(', ');
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
