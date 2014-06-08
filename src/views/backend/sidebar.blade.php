<div class="sidebar navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{Admin::url()}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            @foreach(Admin::modules() as $module)
            @if($module->canBeListed())
            <li>
                <a href="{{Admin::url($module->plural())}}"><i class="fa {{$module->icon}} fa-fw"></i> {{$module->display_name}}</a>
            </li>
            @endif
            @endforeach
            <li class="divider"></li>
            <li class="divider"></li>
            @if(Entrust::can('list_modules'))
            <li>
                <a href="{{Admin::url('modules')}}"><i class="fa fa-puzzle-piece fa-fw"></i> Modules</a>
            </li>
            @endif
            @if(Entrust::can('list_users'))
            <li>
                <a href="{{Admin::url('users')}}"><i class="fa fa-user fa-fw"></i> Users</a>
            </li>
            @endif
            @if(Entrust::can('list_roles'))
            <li>
                <a href="{{Admin::url('roles')}}"><i class="fa fa-group fa-fw"></i> Roles</a>
            </li>
            @endif
            @if(Entrust::can('list_permissions'))
            <li>
                <a href="{{Admin::url('permissions')}}"><i class="fa fa-lock fa-fw"></i> Permissions</a>
            </li>
            @endif
            @if(Entrust::can('list_languages'))
            <li>
                <a href="{{Admin::url('languages')}}"><i class="fa fa-flag fa-fw"></i> Languages</a>
            </li>
            @endif
            @yield('sidemenu_append')
        </ul><!-- /#side-menu -->
        @yield('sidebar_append')
    </div><!-- /.sidebar-collapse -->
</div>