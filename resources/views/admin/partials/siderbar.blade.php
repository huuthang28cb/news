<div class="navbar nav_title" style="border: 0;">
    <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Admin Manager</span></a>
</div>

<div class="clearfix"></div>

<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="{{ asset('admin_gentelella/production/images/img.jpg') }}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2>Admin</h2>
    </div>
</div>
<!-- /menu profile quick info -->

<br />

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3></h3>
        <ul class="nav side-menu">
            <li>
                <a href="/" class="nav-link">
                    <i class="fa fa-home">
                    </i> Home </span>
                </a>
            </li>
        
            <li>
                <a href="{{route('categories.index')}}" class="nav-link">
                    <i class="fa fa-tasks"></i> Categories </span>
                </a>   
            </li>

            <li>
                <a href="{{route('topics.index')}}" class="nav-link">
                    <i class="fa fa-cube"></i> Topics </span>
                </a>   
            </li>

            <li>
                <a>
                    <i class="fa fa-paste"></i></i> Posts </span>
                </a>   
            </li>

            <li>
                <a>
                    <i class="fa fa-users"></i> Users </span>
                </a>   
            </li>
        
        </ul>
    </div>
    

</div>
<!-- /sidebar menu -->
