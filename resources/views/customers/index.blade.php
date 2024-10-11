@extends('layouts.app', [
'namePage' => 'Customers',
'class' => 'sidebar-mini',
'activePage' => 'customers',
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
                    <a href="{{ route('customers.create') }}" class="btn btn-primary btn-round text-white pull-right" href="#">Add customer</a>
                    <h4 class="card-title">Customers</h4>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($customers) == 0)
                            <tr>
                                <td colspan="9" class="text-center bg-light"> No data found.</td>
                            </tr>
                            @endif
                            @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email}}</td>
                                <td>{{ $customer->address}}</td>
                                <td class="text-right">
                                    <a type="button" href="{{ route('customers.edit',$customer->id) }}" rel="tooltip"
                                        class="text-white ml-3" data-original-title="" title="">
                                        <i class="fa fa-edit" style="color: #4bb5ff;font-size: 20px;"></i>
                                    </a>
                                    <a type="button" href="javascript:void(0);" onclick="
                                        if(confirm('Are you sure you want to delete this data?')){
                                            document.getElementById('del_<?php echo $customer->id; ?>').submit();
                                        }
                                        " rel="tooltip" class="text-white ml-3" data-original-title="" title="">
                                        <i class="fa fa-trash" style="color: #4bb5ff;font-size: 20px;"></i>
                                    </a>
                                    <form id="del_<?php echo $customer->id; ?>"
                                        action="{{ route('customers.destroy', $customer->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $customers->links('pagination::bootstrap-5') }}
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