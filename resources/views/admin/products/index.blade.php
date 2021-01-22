@extends('layouts.admin')

@section('title', 'BioTech - Terméklista')

@section('header', 'Termékek listája')

@section('content')
<table class="table table-bordered" js-products-table data-ajax="{{ route('products.getProductsTableData') }}">
    <thead>
        <tr class="text-center">
            <th data-data="name" data-class-name="align-middle">Termék neve</th>
            <th data-data="tags" data-default-content="" data-class-name="text-center align-middle">Címkék</th>
            <th data-data="public_from" data-class-name="text-center align-middle">Publikálás kezdete</th>
            <th data-data="public_to" data-class-name="text-center align-middle">Publikálás vége</th>
            <th data-data="created_at" data-class-name="text-center align-middle">Létrehozva</th>
            <th data-data="updated_at" data-class-name="text-center align-middle">Módosítva</th>
            <th data-data="actions" data-searchable="false" data-orderable="false" data-class-name="text-center align-middle">Műveletek</th>
        </tr>
    </thead>
</table>
@endsection

@section('buttons')
    <a href="{{ route('products.create') }}" class="btn btn-success">Új termék hozzáadása</a>
@endsection

@push('scripts')
    <script src="{{ mix('/js/pages/products/index.js') }}"></script>
@endpush

@push('styles')
    <style>
        .ProductsTable th {
            text-align: center;
        }
    </style>
@endpush