<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Locale;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        Product::create($request->all());

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
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
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
        $product->tags()->delete();
        $product->delete();

        return response('', 200);
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
