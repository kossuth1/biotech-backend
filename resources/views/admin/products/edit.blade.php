@extends('layouts.admin')

@section('title', 'BioTech - Termék létrehozása')

@section('header', 'Új termék hozzáadása')

@section('content')
    <ul class="nav nav-tabs">
    @foreach ($locales as $i => $locale)
      <li class="nav-item">
          <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab" href="#locale_{{ $i }}">{{ $locale['name'] }}</a>
      </li>
    @endforeach
    </ul>
    <form action="{{ route('products.update', $product->id) }}" method="POST" id="product-form">
      <div class="tab-content p-3" id="myTabContent">
        @foreach ($locales as $i => $locale)
      <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" id="locale_{{ $i }}" role="tabpanel" aria-labelledby="home-tab">
            @csrf()
            @method('patch')
            <div class="form-group">
              <label>Termék neve ({{ $locale['name'] }})</label>
            <input value="{{ $product->translate($locale['id'])->name }}" type="text" name="{{ $locale['id'] }}[name]" class="form-control" required />
            </div>
            <div class="form-group">
              <label>Leírás ({{ $locale['name'] }})</label>
              <textarea type="text" name="{{ $locale['id'] }}[description]" class="form-control" rows="5" js-product-description required>
                {{ $product->translate($locale['id'])->description }}
              </textarea>
            </div>      
          </div>
          @endforeach
        </div>
        <div class="card-body">
        <div class="form-group">
          <label>Címkék ({{ $locale['name'] }})</label>
          <select class="form-control" name="tags" multiple js-product-tags></select>
        </div>
        <div class="form-group">
          <label>Ár</label>
            <input type="number" name="price" class="form-control w-auto" value="{{ $product->price }}" required />
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group ">
              <label>Publikálás kezdete</label>
              <input type="datetime-local" name="public_from" class="form-control"  value="{{ $product->public_from }}" required />
            </div>
          </div>
          <div class="col">

            <div class="form-group">
              <label>Publikálás vége</label>
              <input type="datetime-local" name="public_to" class="form-control" value="{{ $product->public_to }}" required />
            </div>   
          </div>
        </div>    
      </div>
    </form>
@endsection

@section('buttons')
  <button type="submit" form="product-form" class="btn btn-primary">Küldés</button>
  <a href="{{ route('products.index') }}" class="btn btn-secondary">Mégsem</a>
@endsection

@push('scripts')
    <script src="{{ mix('/js/pages/products/create.js') }}"></script>
@endpush

@push('styles')
  <style>
    .select2-container {
      width: 100% !important;
    }
  </style>
@endpush