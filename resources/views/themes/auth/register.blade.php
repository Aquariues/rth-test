@extends('themes.layouts.app')

@section('content')

<section class="intro-single">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="title-single-box">
          <h1 class="title-single">Register Account</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section news-grid grid>
  <div class="container" >
    {!! Form::open(['url' => 'register', 'method'=>'post']) !!}
    <div class="row col-md-6 mb-12 center-form">
      <div class="col-md-12 mb-12 ">
        <div class="form-group">
          {{ Form::label('name','Name *') }}
          {{ Form::text('name','',['class'=>'form-control form-control-lg form-control-a','placeholder'=>'Tell me your name','required'=>'true']) }}
        </div>
      </div>
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
        {{ Form::submit('Register',['class'=>'btn btn-primary pull-right'])}}
      </div>
      <div class="col-md-12 mb-12">
        Have an account? <a class="mt-3 text-success" href="{{url('login')}}">Login here !</a>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</section>

@endsection
