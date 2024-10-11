@extends('layouts.app', [
    'namePage' => 'HOme',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])

@section('content')
  <div class="panel-header panel-header-lg">
  </div>
  <div class="content">
    <div class="row">
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card  card-tasks">
          <div class="card-header ">
            <h2>Welcome to Invoice System</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
@endpush