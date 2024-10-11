@if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" aria-hidden="true" data-dismiss="alert" class="close">
          <i class="now-ui-icons ui-1_simple-remove"></i>
        </button>
        <span>{{ session('success') }}</span>
    </div>
@endif
@if(session('failure'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" aria-hidden="true" data-dismiss="alert" class="close">
          <i class="now-ui-icons ui-1_simple-remove"></i>
        </button>
        <span>{{ session('failure') }}</span>
    </div>
@endif