@extends('themes.layouts.app')

@section('content')
<style>
.attachment__progress{
  display: none!important;
}
</style>
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
    <?php $url = 'posts/'.$posts->id; ?>
    {!! Form::open(['url' => "$url", 'method'=>'put', 'files'=>'true']) !!}
    <div class="row">
      <div class="col-md-6 mb-12">
        <div class="form-group">
          {{ Form::label('title','Title *') }}
          {{ Form::text('title',$posts->title,['class'=>'form-control form-control-lg form-control-a','placeholder'=>'Write title here...','required'=>'true']) }}
        </div>
      </div>
      <div class="col-md-6 mb-12">
        <div class="form-group">
          {{ Form::label('category','Category *') }}
          {{ Form::select('category',$list_category,$posts->categories_id,['class'=>'form-control form-control-lg form-control-a']) }}
        </div>
      </div>
      <div class="col-md-12 mb-12">
        <div class="form-group">
          {{ Form::label('content','Content *') }}
          <input id="short_desc" type="hidden" name="contents" value="{{$posts->contents}}" >
          <trix-editor input="short_desc" placeholder=""></trix-editor>
        </div>
      </div>
      <div class="col-md-6 mb-12">
        <div class="form-group">
          {{ Form::label('image','Image') }}
          {{ Form::file('image',['class'=>'form-control form-control-lg form-control-a']) }}
        </div>
      </div>
      <div class="col-md-12 mb-12">
        <div class="form-group">
          <img src="{{$posts->image}}" alt="" class="img-b img-fluid">
        </div>
      </div>
      <div class="col-md-12">
        {{ Form::submit('Edit Post',['class'=>'btn btn-primary pull-right'])}}
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</section>

@endsection
