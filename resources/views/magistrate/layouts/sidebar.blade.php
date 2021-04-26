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
          <li class="treeview">
              <a href="#">
                  <i class="fa fa-user"></i>
                  <span>Cases</span>
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                  <li><a href="{{ route('home') }}"><i class="fa fa-circle-o"></i>Active</a></li>
                  <li><a href="{{ route('workedon-magistrate') }}"><i class="fa fa-circle-o"></i>Worked on</a></li>
              </ul>
          </li>
    </ul>



    </section>
    <!-- /.sidebar -->
  </aside>
