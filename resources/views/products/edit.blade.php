@extends('layouts.app', [
'class' => 'sidebar-mini ',
'namePage' => 'Edit Product',
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
                    <h5 class="card-title">{{ __(' Edit Product') }}</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('productlist.update', $product->id) }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('alerts.success')

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Product Name') }}</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Product Name" value="{{ old('name', $product->name) }}">
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Product Number') }}</label>
                                    <input type="number" name="number" class="form-control"
                                        placeholder="Product Number" value="{{ old('number', $product->number) }}" readonly>
                                    @include('alerts.feedback', ['field' => 'number'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Product Quantity') }}</label>
                                    <input type="number" name="quantity" class="form-control"
                                        placeholder="Product Quantity" value="{{ old('quantity', $product->quantity) }}">
                                    @include('alerts.feedback', ['field' => 'quantity'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Purchase Price') }}</label>
                                    <input type="number" name="purchase_price" class="form-control"
                                        placeholder="Purchase Price" value="{{ old('purchase_price', $product->purchase_price) }}">
                                    @include('alerts.feedback', ['field' => 'purchase_price'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Selling Price') }}</label>
                                    <input type="number" name="selling_price" class="form-control"
                                        placeholder="Selling Price" value="{{ old('selling_price', $product->selling_price) }}">
                                    @include('alerts.feedback', ['field' => 'selling_price'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                <label>{{__(" Product Image")}}</label>
                                <input type="file" name="product_image" id="selectImage" name="selectImage" onchange="readURL(this)" class="form-control unit_filetype @error('image') is-invalid @enderror" accept="image/jpeg, image/png, image/svg+xml, image/webp">
                                <div class="form-group">
                                    <img id="preview" src="{{ asset('products/'.$product->image) }}" style="width: 70px;height:70px">
                                </div>
                                @include('alerts.feedback', ['field' => 'image'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('SGST') }}</label>
                                    <input type="number" name="sgst" class="form-control"
                                        placeholder="SGST" value="{{ old('sgst', $product->sgst) }}">
                                    @include('alerts.feedback', ['field' => 'sgst'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('CGST') }}</label>
                                    <input type="number" name="cgst" class="form-control"
                                        placeholder="CGST" value="{{ old('cgst', $product->cgst) }}">
                                    @include('alerts.feedback', ['field' => 'cgst'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('IGST') }}</label>
                                    <input type="number" name="igst" class="form-control"
                                        placeholder="IGST" value="{{ old('igst', $product->igst) }}">
                                    @include('alerts.feedback', ['field' => 'igst'])
                                </div>
                            </div>
                        </div>

                        <div class="card-footer ">
                            <button type="submit" class="btn btn-primary btn-round">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
