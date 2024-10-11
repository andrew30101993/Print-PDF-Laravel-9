<div class="sidebar" data-color="orange">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="javascript:void(0)" class="simple-text logo-normal text-center">
      {{ __('Invoice System') }}
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
    
      <li class="@if ($activePage == 'products') active @endif">
        <a href="{{ route('productlist.index') }}">
          <h5>{{ __('Products') }}</h5>
        </a>
      </li>
      <li class="@if ($activePage == 'customers') active @endif">
        <a href="{{ route('customers.index') }}">
        <h5>{{ __('Customers') }}</h5>
        </a>
      </li>
      <li class="@if ($activePage == 'invoices') active @endif">
        <a href="{{ route('invoices.index') }}">
          <h5> {{ __("Invoices") }} </h5>
        </a>
      </li> 
    </ul>
  </div>
</div>