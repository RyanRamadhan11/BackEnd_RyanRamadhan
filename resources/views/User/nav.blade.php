<meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets_user/img/favicon.png" rel="icon">
  <link href="assets_user/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets_user/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets_user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets_uservendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets_user/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets_user/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets_user/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets_user/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets_user/css/style.css" rel="stylesheet">

  <link href="{{ url('assets_user/img/tea.png') }}" rel="icon">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="" class="fixed-top py-3" style="background-color: black;">
    <div class="container d-flex align-items-center">

    <div class="container d-flex align-items-center justify-content-between">
      <div style="display: flex; align-items: center;">
          <img src="assets_user/img/logo_x.png" style="width: 40px; height: 40px;" alt="">
          <h2 class="logo ms-4"><a href="index.html">RR</a></h2>
      </div>

        <nav id="navbar" class="navbar">
            <ul>
                @if(empty(Auth::user()))
                <a href="{{ url('/login') }}" class="nav-item nav-link" style="margin-left: 10px; margin-right: 40px; ">LogIn</a>
                @else
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="margin-left: 10px;">Pesanan</a>
                        <div class="dropdown-menu text-capitalize">
                        <a href="{{ url('/cart') }}" class="dropdown-item">
                            <i class="bi bi-cart-plus-fill"></i>
                                        <span style="padding-left: 10px;"> Pesanan Ku </span>
                                    </a>

                                    <hr class="dropdown-divider">
                                    <a href="{{ url('/metode-pembayaran') }}" class="dropdown-item">
                                        <i class="bi bi-envelope-paper bi bi-cash"></i>
                                        <span style="padding-left: 10px;"> Metode Pembayaran</span>
                                    </a>

                                    <hr class="dropdown-divider">
                                    
                                    <hr class="dropdown-divider">
                                    <a href="{{ url('bayar') }}" class="dropdown-item">
                                        <i class="bi bi-hourglass-split"></i>
                                        <span style="padding-left: 10px;"> Status Pembayaran </span>
                                    </a>
                                </div>
                            </div> 

                            <!-- Navbar-->
                            <div class="nav-item dropdown" style="margin-right: 50px;">
                                <a class="nav-link nav-profile d-flex align-items-center " href="#" data-bs-toggle="dropdown">     
                                    
                                    <span class="d-none d-md-block dropdown-toggle ps-2" style="margin-left: 5px;">
                                        @if(empty(Auth::user()->name))
                                            {{ '' }}
                                        @else
                                            {{ Auth::user()->name }}
                                        @endif
                                    </span>
                                
                                </a><!-- End Profile Iamge Icon -->

                                <div class="dropdown-menu text-capitalize text-black">
                                    <span class="d-none d-md-block text-center ps-2" style="font-weight: bold; font-size: 16px;">
                                        @if(empty(Auth::user()->name))
                                            {{ '' }}
                                        @else
                                            {{ Auth::user()->name }}
                                        @endif
                                    </span>
                                    <span class="d-none d-md-block text-center text-black" style="font-size: 14px; ">
                                        @if(empty(Auth::user()->role))
                                            {{ '' }}
                                        @else
                                            {{ Auth::user()->role }}
                                        @endif
                                    </span>
                                    
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                        
                                        <a class="dropdown-item text-black" style="padding: 2px 5px 2px 2em" href="{{ url('/myprofil') }}">
                                            <p><i class="bi bi-person" style=""></i> My Profile </p>
                                        </a>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                        <a class="dropdown-item text-black" style="padding: 2px 5px 2px 2em" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                                <p> <i class="bi bi-box-arrow-right" style=""></i> {{ __('Logout') }} </p> 
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                </div>
                            </div> 
                        @endif
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        </div>
    </div>
  </header><!-- End Header -->