@extends('themes.layouts.app')

@section('content')

<!-- Header List -->
<section class="intro-single">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="title-single-box">
          <h1 class="title-single">{{$title}}</h1>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Header List -->

<!-- List Grid -->
<section class="news-grid grid">
  <div class="container">
    <div class="row">
      @if(count($posts) > 0)
          @foreach($posts as $r)
            <div class="col-md-4">
              <div class="card-box-b card-shadow news-box">
                <div class="img-box-b">
                  <img src="{{$r->image_resize}}" alt="" class="img-b img-fluid">
                </div>
                <div class="card-overlay">
                  <div class="card-header-b">
                    <div class="card-category-b">
                      <a href="#" class="category-b">{{$r->categories_name}}</a>
                    </div>
                    <div class="card-title-b">
                      <h2 class="title-2">
                        <a href="posts/{{$r->id}}">{{$r->title}}</a>
                        <div class="card-date">
                          <span class="date-b">{{$r->created_at}}</span>
                        </div>
                        <div class="row">
                          <a href="{{url('posts/'.$r->id.'/edit/')}}" class="btn btn-warning">Edit</a>
                          <?php $url_del = 'posts/'.$r->id; ?>
                          {!! Form::open(['url' => $url_del, 'method'=>'delete']) !!}
                          <button type="submit" class="btn btn-danger">Delete</button>
                          {!! Form::close() !!}
                        </div>
                      </h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
       @else
        Oopsss no post here
       @endif
    </div>
  </div>
</section>
<!-- / List Grid -->
@endsection
