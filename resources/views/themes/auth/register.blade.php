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
  <div class="container">
    {!! Form::open(['url' => 'register', 'method'=>'post']) !!}
    <div class="row">
      <div class="col-md-6 mb-12">
        <div class="form-group">
          {{ Form::label('Name ','Name  *') }}
          {{ Form::text('Name ','',['class'=>'form-control form-control-lg form-control-a','placeholder'=>'What should i call you?','required'=>'true']) }}
        </div>
      </div>
      <div class="col-md-6 mb-12">
        <div class="form-group">
          {{ Form::label('email','Email *') }}
          {{ Form::email('email',$list_category,null,['class'=>'form-control form-control-lg form-control-a','placeholder'=>'Aquariues@example.vn','required'=>'true']]) }}
        </div>
      </div>
      <div class="col-md-12 mb-12">
        <div class="form-group">
          {{ Form::label('password','Password *') }}
          {{ Form::password('password',['class'=>'form-control form-control-lg form-control-a','required'=>'true']) }}
        </div>
      </div>
      <div class="col-md-12">
        {{ Form::submit('Submit',['class'=>'btn btn-primary'])}}
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</section>

@endsection
