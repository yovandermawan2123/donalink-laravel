<div class="header-area">
    <div class="main-header ">
       
        <div class="header-bottom header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo">
                            <a href="/" class="text-success" style="font-size: 24px; font-weight:bold;">Dona-Link</a>
                            {{-- <a href="index.html"><img src="../frontend_template//img/logo/logo.png" alt=""></a> --}}
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-10">
                        <div class="menu-wrapper  d-flex align-items-center justify-content-end">
                            <!-- Main-menu -->
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">                                                                                          
                                        <li><a href="/">Home</a></li>
                                        {{-- <li><a href="about.html">About</a></li> --}}
                                        <li><a href="/all-campaign">Campaign</a></li>
                                        <li><a href="/all-category">Category</a></li>
                                        @if (Auth::check())
                                            <li><a href="/my-donation">My Donation </a></li>
                                        @endif
                                        {{-- <li><a href="blog.html">Blog</a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="blog_details.html">Blog Details</a></li>
                                                <li><a href="elements.html">Element</a></li>
                                            </ul>
                                        </li> --}}
                                        {{-- <li><a href="contact.html">Contact</a></li> --}}
                                    </ul>
                                    
                                </nav>
                            </div>
                            <!-- Header-btn -->
                            @if (Auth::check())
                                {{-- <div class="header-right-btn d-none d-lg-block ml-20">
                                    <a href="/login" class="btn header-btn">{{ Auth::user()->name }}</a>
                                </div> --}}

                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @if (Auth::user()->role->name == 'Admin')
                                            
                                        <a href="/dashboard" class="dropdown-item" type="submit"><i class="bi bi-box-arrow-in-right"></i>Dashboard</a>
                                        @endif
                                        <form action="/logout" method="POST" >
                                            @csrf
                                            <button class="dropdown-item" type="submit"><i class="bi bi-box-arrow-in-right"></i> Logout</button>
                                        </form>
                                      
                                    </div>
                                  </div>

                                  
                            @else
                                <div class="header-right-btn d-none d-lg-block ml-20">
                                    <a href="/login" class="btn header-btn">Login</a>
                                </div>
                            @endif
                        </div>
                    </div> 
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>