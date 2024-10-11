@extends('layouts.app', [
'namePage' => 'Invoices',
'class' => 'sidebar-mini',
'activePage' => 'invoices',
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
                    <a href="{{ route('invoices.create') }}" class="btn btn-primary btn-round text-white pull-right" href="#">Add Invoice</a>
                    <h4 class="card-title">Invoices</h4>
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
                                <th>Customer Name</th>
                                <th>Invoice Number</th>
                                <th>Salesman Name</th>
                                <th>Date</th>
                                <th>Sub Total</th>
                                <th>GST Total</th>
                                <th>Grand Total</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($invoices) == 0)
                            <tr>
                                <td colspan="9" class="text-center bg-light"> No data found.</td>
                            </tr>
                            @endif
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->customer_name }}</td>
                                <td>{{ $invoice->invoice_number}}</td>
                                <td>{{ $invoice->salesman_name}}</td>
                                <td>{{ $invoice->invoice_date}}</td>
                                <td>{{ $invoice->invoice_date}}</td>
                                <td>{{ $invoice->gst_total}}</td>
                                <td>{{ $invoice->grand_total}}</td>
                                <td class="text-right">
                                    <a type="button" href="{{ route('invoices.show',$invoice->id) }}" rel="tooltip"
                                        class="text-white ml-3" data-original-title="" title="">
                                        <i class="fa fa-eye" style="color: #4bb5ff;font-size: 20px;"></i>
                                    </a>
                                    <a type="button" href="javascript:void(0);" onclick="
                                        if(confirm('Are you sure you want to delete this data?')){
                                            document.getElementById('del_<?php echo $invoice->id; ?>').submit();
                                        }
                                        " rel="tooltip" class="text-white ml-3" data-original-title="" title="">
                                        <i class="fa fa-trash" style="color: #4bb5ff;font-size: 20px;"></i>
                                    </a>
                                    <form id="del_<?php echo $invoice->id; ?>"
                                        action="{{ route('invoices.destroy', $invoice->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $invoices->links('pagination::bootstrap-5') }}
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