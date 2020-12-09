<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>AQ Blog</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{url('/assets/img/favicon.png')}}" rel="icon">
  <link href="{{url('/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{url('/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('/assets/vendor/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{url('/assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{url('/assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{url('/assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="{{url('/assets/css/style.css')}}" rel="stylesheet">
  @trixassets
</head>

<body>

  <div class="box-collapse">
    <div class="title-box-d">
      <h3 class="title-d">Search</h3>
    </div>
    <span class="close-box-collapse right-boxed ion-ios-close"></span>
    <div class="box-collapse-wrap form">
      {!! Form::open(['url' => 'search', 'method'=>'get','class'=>'form-a']) !!}
        <div class="row">
          <div class="col-md-12 mb-2">
            <div class="form-group">
              {{ Form::label('keyword','Keyword') }}
              {{ Form::text('keyword','',['class'=>'form-control form-control-lg form-control-a','placeholder'=>'Tell me what are you finding']) }}
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group">
              {{ Form::label('category','Category') }}
              {{ Form::select('category',$list_category,null,['class'=>'form-control form-control-lg form-control-a']) }}
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group">
              {{ Form::label('sort','Sort') }}
              {{ Form::select('sort',$sort,null,['class'=>'form-control form-control-lg form-control-a']) }}
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-b pull-right">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- End Property Search Section -->>

  <!-- Header/Navbar -->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="{{url('home')}}">AQ<span class="color-b">Blog</span></a>
      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="{{url('home')}}">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Posts
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{url('posts')}}">List Post</a>
              <a class="dropdown-item" href="{{url('my-posts')}}">My Post</a>
              <a class="dropdown-item" href="{{url('posts/create')}}">Create Post</a>
            </div>
          </li>
          <li class="nav-item ml-3">
            @if(Session::has('users'))
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="logout" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hi, {{Session::get('users')->name}}
              </a>
              <div class="dropdown-menu" aria-labelledby="logout">
                <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
              </div>
            </li>
            @else
              <a class="nav-link" href="{{url('login')}}">Login</a>
            @endif
          </li>
    </div>
    <button type="button" class="btn btn-b-n navbar-toggle-box-collapse d-none d-md-block" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-expanded="false">
      <span class="fa fa-search" aria-hidden="true"></span>
    </button>
  </nav>
  <!-- End Header/Navbar -->

  <main id="main">

    @include('themes.flash.flash-message')

    @yield('content')

  </main>
  <!-- End #main -->
  <section class="section-footer">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-md-12">
          From Long with luv <3
        </div>
      </div>
    </div>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            RTH - Test specification - Backend - PHP
        </div>
      </div>
    </div>
  </footer>
</section>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{url('/assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{url('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('/assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
  <script src="{{url('/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{url('/assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
  <script src="{{url('/assets/vendor/scrollreveal/scrollreveal.min.js')}}"></script>


  <!-- Template Main JS File -->
  <script src="{{url('/assets/js/main.js')}}"></script>

</body>

</html>
