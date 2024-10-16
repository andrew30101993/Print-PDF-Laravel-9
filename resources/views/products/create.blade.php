@extends('layouts.app', [
'class' => 'sidebar-mini ',
'namePage' => 'Products',
'activePage' => 'products',
'activeNav' => '',
])


@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ __(' Add Product') }}</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('productlist.store') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        @include('alerts.success')
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Product Name') }}</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Product Name" value="{{ old("name") }}">
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Product Number') }}</label>
                                    <input type="number" name="number" class="form-control"
                                        placeholder="Product Number" value="{{ $number }}" readonly>
                                    @include('alerts.feedback', ['field' => 'number'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Product Quantity') }}</label>
                                    <input type="text" name="quantity" class="form-control"
                                        placeholder="Product Quantity" value="{{ old("quantity") }}">
                                    @include('alerts.feedback', ['field' => 'quantity'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Purchase Price') }}</label>
                                    <input type="text" name="purchase_price" class="form-control"
                                        placeholder="Purchase Price" value="{{ old("purchase_price") }}">
                                    @include('alerts.feedback', ['field' => 'purchase_price'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Selling Price') }}</label>
                                    <input type="text" name="selling_price" class="form-control"
                                        placeholder="Selling Price" value="{{ old("selling_price") }}">
                                    @include('alerts.feedback', ['field' => 'selling_price'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                <label>{{__("Product Image")}}</label>
                                <input type="file" name="product_image" id="product_image" class="form-control unit_filetype @error('image') is-invalid @enderror" accept="image/jpeg, image/png, image/svg+xml, image/webp">
                                @include('alerts.feedback', ['field' => 'product_image'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('SGST') }}</label>
                                    <input type="number" name="sgst" class="form-control"
                                        placeholder="SGST" value="{{ old("sgst") }}">
                                    @include('alerts.feedback', ['field' => 'sgst'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('CGST') }}</label>
                                    <input type="number" name="cgst" class="form-control"
                                        placeholder="CGST" value="{{ old("cgst") }}">
                                    @include('alerts.feedback', ['field' => 'cgst'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('IGST') }}</label>
                                    <input type="number" name="igst" class="form-control"
                                        placeholder="IGST" value="{{ old("igst") }}">
                                    @include('alerts.feedback', ['field' => 'igst'])
                                </div>
                            </div>
                        </div>
                        
                        </div>
                        <div class="card-footer ">
                            <button type="submit" class="btn btn-primary btn-round">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection