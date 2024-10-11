@extends('layouts.app', [
'class' => 'sidebar-mini ',
'namePage' => 'Customers',
'activePage' => 'customers',
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
                    <h5 class="card-title">{{ __(' Add Customer') }}</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('customers.store') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        @include('alerts.success')
                        <div class="row">
                        </div>
                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Name" value="">
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Email') }}</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Email" value>
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Address') }}</label>
                                    <input type="address" name="address" class="form-control"
                                        placeholder="Address" value="">
                                    @include('alerts.feedback', ['field' => 'address'])
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