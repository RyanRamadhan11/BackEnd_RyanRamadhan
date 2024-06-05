<div id="layoutSidenav_nav" >
                <nav class="sb-sidenav accordion " style="background-color: black; color:white" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ url('/dashboard') }}" style="color:#2df1f8">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Manage Data Master</div>
                            <a class="nav-link collapsed" style="color:#2df1f8" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Data Master
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <!-- <a class="nav-link" href="{{ url('/users') }}">Data User</a> -->
                                    <a class="nav-link" style="color:white" href="{{ url('/posts') }}">Data Posts</a>
                                    <a class="nav-link" style="color:white" href="{{ url('/categories') }}">Data Categories</a>
                                    <a class="nav-link" style="color:white" href="{{ url('/comments') }}">Data Comments</a>
                                </nav>
                            </div>
                   
                            @if(Auth::user()->role == 'Admin')
                            <div class="sb-sidenav-menu-heading">Manage Data Users</div>
                                <a class="nav-link" href="{{ url('/kelola_user') }}" style="color:#2df1f8">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Kelola Data Users  
                                </a>
                            @endif
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer " style="background-color: black; color:white" >
                        <div class="small">Design By :</div>
                        Ryan Ramadhan 
                    </div>
                </nav>
            </div>