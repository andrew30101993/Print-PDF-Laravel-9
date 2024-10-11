@extends('layouts.app', [
'namePage' => 'Products',
'class' => 'sidebar-mini',
'activePage' => 'products',
])

@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">

            @include('layouts.messages')

            <div class="card">
                <div class="card-header">
                    <a href="{{ route('productlist.create') }}" class="btn btn-primary btn-round text-white pull-right" href="#">Add Product</a>
                    <h4 class="card-title">Products</h4>
                    <div class="col-12 mt-2">
                    </div>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                    </div>
                    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="15%">Product Name</th>
                                <th width="15%">Product Number</th>
                                <th width="15%">Purchase Pricth</th>
                                <th width="15%">Selling Price</th>
                                <th width="15%">Quantity</th>
                                <th width="10%" class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($products) == 0)
                            <tr>
                                <td colspan="9" class="text-center bg-light"> No data found.</td>
                            </tr>
                            @endif
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->number}}</td>
                                <td>${{ $product->purchase_price}}</td>
                                <td>${{ $product->selling_price}}</td>
                                <td>{{ $product->quantity}}</td>
                                <td class="text-right">
                                    <a type="button" href="{{ route('productlist.edit',$product->id) }}" rel="tooltip"
                                        class="text-white ml-3" data-original-title="" title="">
                                        <i class="fa fa-edit" style="color: #4bb5ff;font-size: 20px;"></i>
                                    </a>
                                    <a type="button" href="javascript:void(0);" onclick="
                                        if(confirm('Are you sure you want to delete this data?')){
                                            document.getElementById('del_<?php echo $product->id; ?>').submit();
                                        }
                                        " rel="tooltip" class="text-white ml-3" data-original-title="" title="">
                                        <i class="fa fa-trash" style="color: #4bb5ff;font-size: 20px;"></i>
                                    </a>
                                    <form id="del_<?php echo $product->id; ?>"
                                        action="{{ route('productlist.destroy', $product->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
    <!-- end row -->
</div>
@endsection