<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('avatar.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i>Logged in</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li><a href="{{ route('home') }}"><i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span></a></li>
          <li><a href="{{ route('stations.index') }}"><i class="fa fa-home text-aqua"></i> <span>Police stations</span></a></li>
          <li><a href="{{ route('courts.index') }}"><i class="fa fa-gavel text-aqua"></i> <span>Courts</span></a></li>
          <li><a href="{{ route('station_admins.index') }}"><i class="fa fa-users text-aqua"></i> <span>Station admins</span></a></li>
          <li><a href="{{ route('court_admins.index') }}"><i class="fa fa-user-circle text-aqua"></i> <span>Court admins</span></a></li>
          <li><a href="{{ route('offences.index') }}"><i class="fa fa-warning text-aqua"></i> <span>Offence categories</span></a></li>
          <li><a href="{{ route('partners.index') }}"><i class="fa fa-home text-aqua"></i> <span>Partners</span></a></li>

    </ul>



    </section>
    <!-- /.sidebar -->
  </aside>
