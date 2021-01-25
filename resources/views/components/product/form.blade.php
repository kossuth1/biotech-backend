@php
    $product = $product ?? null;
    $method = $method ?? 'post';
    $action = $action ?? route('products.store');
@endphp

<form action="{{ $action }}" method="POST" js-product-form id="product-form">
  @csrf
  @method($method)
</form>

<div class="tab-content p-3">
    @foreach ($locales as $i => $locale)
    <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" id="locale_{{ $i }}">    
        <div class="form-group">
            <label>Termék neve ({{ $locale['name'] }})</label>
            <input type="text" name="{{ $locale['id'] }}[name]" form="product-form" value="{{ old($locale['id'] . '.name') ?? ($product ? $product->translate($locale['id'])->name : '') }}" class="form-control" required />
        </div>
        <div class="form-group">
            <label>Leírás ({{ $locale['name'] }})</label>
            <textarea type="text" name="{{ $locale['id'] }}[description]" form="product-form" class="form-control" rows="5" js-product-description required>
                {{ old($locale['id'] . '.description') ?? ($product ? optional($product)->translate($locale['id'])->description : '') }}
            </textarea>
        </div>  
        <div class="form-group">
            <label>Címkék</label>
            <select class="form-control" name="tags[][{{ $locale['id'] }}][name]" form="product-form" value="{{ old('tags') ?? ($product ? $product->tags->implode('name', ',') : '') }}" multiple js-product-tags></select>
        </div>    
    </div>
    @endforeach
    <div class="card-body">
        <x-image-upload
            name="images"
            :url="route('products.uploadImage')"
            :entity='$product'
        />
        <div class="form-group">
            <label>Ár</label>
            <input type="number" name="price" form="product-form" class="form-control w-auto" value="{{ old('price') ?? optional($product)->price }}" required />
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group ">
                    <label>Publikálás kezdete</label>
                    <input type="text" form="product-form" name="public_from" class="form-control" js-product-public-from value="{{ old('public_from') ?? optional($product)->public_from }}" required />
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Publikálás vége</label>
                    <input type="text" form="product-form" name="public_to" class="form-control" js-product-public-to value="{{ old('public_to') ?? optional($product)->public_to }}" required />
                </div>   
            </div>
        </div>    
    </div>
</div>

