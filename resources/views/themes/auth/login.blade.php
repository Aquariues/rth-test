@extends('themes.layouts.app')

@section('content')

<style>
.center-form{
  background-color: #f8f9fa;
  border-radius: 20px;
  margin: 0 auto;
  overflow: hidden;
  padding: 10px 0;
  align-items: center;
  justify-content: space-around;
  display: flex;
  float: none;
}
</style>

<section class="intro-single">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="title-single-box">
          <h1 class="title-single">Welcome to AQ Blog</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section news-grid grid>
  <div class="container" >
    {!! Form::open(['url' => 'login', 'method'=>'post']) !!}
    <div class="row col-md-6 mb-12 center-form">
      <div class="col-md-12 mb-12 ">
        <div class="form-group">
          {{ Form::label('Email','Email *') }}
          {{ Form::text('email','',['class'=>'form-control form-control-lg form-control-a','placeholder'=>'Aquariues@example.com','required'=>'true']) }}
        </div>
      </div>
      <div class="col-md-12 mb-12">
        <div class="form-group">
          {{ Form::label('password','Password *') }}
          {{ Form::password('password',['class'=>'form-control form-control-lg form-control-a','required'=>'true']) }}
        </div>
      </div>
      <div class="col-md-12 mb-12">
        {{ Form::submit('Login',['class'=>'btn btn-primary pull-right'])}}
      </div>
      <div class="col-md-12 mb-12">
        Don't have an account? <a class="mt-3 text-success" href="{{url('register')}}">Register here !</a>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</section>

@endsection
