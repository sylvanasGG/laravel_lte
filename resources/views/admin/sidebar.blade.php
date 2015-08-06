<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        {{--<div class="user-panel">--}}
            {{--<div class="pull-left image">--}}
                {{--<img src="{{ asset("/admin-lte/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image" />--}}
            {{--</div>--}}
            {{--<div class="pull-left info">--}}
                {{--<p>Alexander Pierce</p>--}}
                {{--<!-- Status -->--}}
                {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
            {{--</div>--}}
        {{--</div>--}}

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                  <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            @foreach($menus as $menu)
                <?php
                $active = '';
                if(str_is($menu['treeView']['actionName'].'*', $_actionName))
                {
                    $active = 'active';
                }
                ?>
                <li class="treeview {{ $active }}">
                    <a href="#">
                        <i class="fa {{$menu['treeView']['icon']}}"></i> <span>{{$menu['treeView']['name']}}</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        @foreach($menu['treeViewMenu'] as $treeViewMenu)
                            <li class="@if($_actionName == $treeViewMenu['actionName']) active @endif"><a href="{{ $treeViewMenu['url'] }}"><i class="fa {{$treeViewMenu['icon']}}"></i> {{$treeViewMenu['name']}}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>