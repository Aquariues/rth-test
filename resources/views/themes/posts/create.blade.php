@extends('themes.layouts.app')

@section('content')

<section class="intro-single">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="title-single-box">
          <h1 class="title-single">Create Post</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section news-grid grid>
  <div class="container">
    {!! Form::open(['url' => 'posts', 'method'=>'post']) !!}
    <div class="row">
      <div class="col-md-6 mb-12">
        <div class="form-group">
          {{ Form::label('title','Title *') }}
          {{ Form::text('title','',['class'=>'form-control form-control-lg form-control-a','placeholder'=>'Write title here...','required'=>'true']) }}
        </div>
      </div>
      <div class="col-md-6 mb-12">
        <div class="form-group">
          {{ Form::label('category','Category *') }}
          {{ Form::select('category',$list_category,null,['class'=>'form-control form-control-lg form-control-a']) }}
        </div>
      </div>
      <div class="col-md-12 mb-12">
        <div class="form-group">
          {{ Form::label('content','Content *') }}
          @trix(\App\Article::class, 'content')
        </div>
      </div>
      <div class="col-md-12">
        {{ Form::submit('Submit',['class'=>'btn btn-primary pull-right'])}}
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</section>

@endsection
