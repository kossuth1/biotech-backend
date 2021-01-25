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
    <x-product.form
      :locales="$locales"
    ></x-product.form>
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