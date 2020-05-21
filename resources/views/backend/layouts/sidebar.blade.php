 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
           <img src="{{url('backend/dist/img/me.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      @php
        $route_name=\Request::route()->getName();
      @endphp
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
          <li class="treeview @if($route_name=='companies' || $route_name=='create-company' )  active menu-open @endif">
            <a href="#">
              <i class="fa fa-building"></i>
              <span>Companies</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@if(\Request::route()->getName()=='companies') active @endif"><a href="{{route('companies')}}"><i class="fa fa-circle-o"></i> All Companies</a></li>
              <li class="@if(\Request::route()->getName()=='create-company') active @endif"><a href="{{route('create-company')}}"><i class="fa fa-circle-o"></i> Add Company</a></li>
            </ul>
          </li>
          <li class="treeview @if($route_name=='invoices' || $route_name=='create-invoice' )  active menu-open @endif">
              <a href="#">
                  <i class="fa fa-book"></i>
                  <span>Invoice</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                  <li class="@if(\Request::route()->getName()=='invoices') active @endif"><a href="{{route('invoices')}}"><i class="fa fa-circle-o"></i> All Invoice</a></li>
                  <li class="@if(\Request::route()->getName()=='create-invoice') active @endif"><a href="{{route('create-invoice')}}"><i class="fa fa-circle-o"></i> Add Invoice</a></li>
              </ul>
          </li>
          
          @if(Auth::user()->role=='admin')
          <li class="treeview @if($route_name=='users.index' || $route_name=='users.create' )  active menu-open @endif">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>Users</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@if(\Request::route()->getName()=='users.index') active @endif"><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i> All Users</a></li>
              <li class="@if(\Request::route()->getName()=='users.create') active @endif"><a href="{{route('users.create')}}"><i class="fa fa-circle-o"></i> Add User</a></li>
            </ul>
          </li>
          @endif

          <li class="treeview @if($route_name=='categories.create' || $route_name=='income_expenses.index' || $route_name=='income_expenses.create' || $route_name=='categories.index' )  active menu-open @endif">
            <a href="{{route('income_expenses.index')}}">
                <i class="fa fa-money"> </i>
                <span>Income & Expense</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>

            <ul class="treeview-menu">
              <li class="@if(\Request::route()->getName()=='income_expenses.index') active @endif" ><a href="{{route('income_expenses.index')}}?filter_by=weekly"> <i class="fa fa-circle-o"></i> All Income & Expense</a></li>
              <li class="@if(\Request::route()->getName()=='income_expenses.create') active @endif"><a href="{{route('income_expenses.create')}}"><i class="fa fa-circle-o"></i>Add Income & Expende</a></li>            
              <li class="@if(\Request::route()->getName()=='categories.index') active @endif"><a href="{{route('categories.index')}}"><i class="fa fa-circle-o"></i>All Categories</a></li>
              <li class="@if(\Request::route()->getName()=='categories.create') active @endif"><a href="{{route('categories.create')}}"><i class="fa fa-circle-o"></i>Add Category</a></li>
            </ul>

        </li>
        <li class="treeview active menu-open">
            <li class="@if(\Request::route()->getName()=='official-documents') active @endif"><a href="{{route('official-documents')}}"><i class="fa fa-folder"></i> Official Documents</a></li>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
