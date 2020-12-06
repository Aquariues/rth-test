@extends('themes.layouts.app')

@section('content')

    <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-12 col-sm-12 col-12">
            <div class="title-single-box">
              <h1 class="title-single">{{$detail->title}}</h1>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Intro Single-->
    <!-- inside view blade file -->


    <section class="news-single nav-arrow-b">
      <div class="container">
        <div class="row">
          <div class="col-md-12 offset-md-1 col-lg-12">
            <!-- post info -->
            <div class="post-information">
              <ul class="list-inline text-center color-a">
                <li class="list-inline-item mr-2">
                  <strong>Author: </strong>
                  <span class="color-text-a">{{$detail->author}}</span>
                </li>
                <li class="list-inline-item mr-2">
                  <strong>Category: </strong>
                  <span class="color-text-a">{{$detail->categories_name}}</span>
                </li>
                <li class="list-inline-item">
                  <strong>Date: </strong>
                  <span class="color-text-a">{{$detail->created_at}}</span>
                </li>
              </ul>
            </div>
            <!-- / post info -->
            <!-- post content -->
            <div class="post-content color-text-a card-box">
              <blockquote class="blockquote">
                <?php echo $detail->contents;?>
              </blockquote>
            </div>
            <!-- / post content -->
            <!-- post comment -->
            <div class="post-footer">
              <div class="post-share">
                <span>Share: </span>
                <ul class="list-inline socials">
                  <li class="list-inline-item">
                    <a href="#">
                      <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#">
                      <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#">
                      <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="#">
                      <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- comment -->
          <div class="col-md-10 offset-md-1 col-lg-10 offset-lg-1">
            <div class="title-box-d">
              <h3 class="title-d">Comments ({{count($comments)}})</h3>
            </div>
            <div class="box-comments">
              <ul class="list-comments">
                @if(count($comments) > 0)
                  @foreach($comments as $comment)
                  <li>
                    <div class="comment-avatar">
                      <img src="{{url('/assets/img/avatar.jpg')}}" alt="">
                    </div>
                    <div class="comment-details">
                      <h4 class="comment-author">{{$comment->name}}</h4>
                      <span>{{$comment->created_at}}</span>
                      <p class="comment-description">
                        {{$comment->comment}}
                      </p>
                    </div>
                  </li>
                  @endforeach
                @else
                  Oops, no commet for this post now
                @endif

            </div>
            <!-- form comment -->

            <div class="form-comments">
              <div class="title-box-d">
                <h3 class="title-d"> Your comment </h3>
              </div>
              @if(Session::has('users'))
              <?php $url = url('comments/'.$detail->id);?>
              {!! Form::open(['url' => $url, 'method'=>'post']) !!}
                <div class="row">
                  <div class="col-md-12 mb-12">
                    <div class="form-group">
                      {{ Form::label('comment','Comment *') }}
                      {{ Form::textarea('comment','',['class'=>'form-control form-control-lg form-control-a','placeholder'=>'Write comment here...','required'=>'true','rows'=>5]) }}
                    </div>
                  </div>
                  <div class="col-md-12">
                    {{ Form::submit('Send Comment',['class'=>'btn btn-primary pull-right'])}}
                  </div>
                </div>
              </form>
              @else
                You need login !!! <a href="{{url('login')}}" >Click here !!! </a>
              @endif
            </div>

            <!-- end form comment -->
          </div>
          <!-- end comment -->
        </div>
      </div>
    </section>

@endsection
