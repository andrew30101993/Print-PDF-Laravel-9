@extends('layouts.app', [
'class' => 'sidebar-mini ',
'namePage' => 'Edit Customer',
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
                    <h5 class="card-title">{{ __(' Edit Customer') }}</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('customers.update', $customer->id) }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('alerts.success')

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Name" value="{{ old('name', $customer->name) }}">
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Email') }}</label>
                                    <input type="text" name="email" class="form-control"
                                        placeholder="Email" value="{{ old('email', $customer->email) }}">
                                    @include('alerts.feedback', ['field' => 'email'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{ __('Address') }}</label>
                                    <input type="text" name="address" class="form-control"
                                        placeholder="Address" value="{{ old('address', $customer->address) }}">
                                    @include('alerts.feedback', ['field' => 'address'])
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
