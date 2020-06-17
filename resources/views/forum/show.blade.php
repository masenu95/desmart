@extends('layouts.forum')

@section('content')
<div class="container">
        <div class="header-forum">
            <span class="header-path">
                <a href="{{ url('/Investment') }}" style="color:black">Smart investor>></a>{{ $fcategory->name }}
            </span>
        </div>
        <div class="header-forum-center">
            <h3>{{ $fcategory->name }}</h3>
            <p>{{ $fcategory->caption }}</p>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="post-title">
                    <div class="row">
                        <div class=" col-lg-8 col-md-8 col-sm-8">
                            TITLE
                        </div>
                        <div class=" col-lg-1 col-md-1 col-sm-1">
                            VIEWS
                        </div>
                        <div class=" col-lg-1 col-md-1 col-sm-1">
                            LIKES
                        </div>
                        <div class=" col-lg-1 col-md-1 col-sm-1">
                            DISLIKES
                        </div>
                        <div class=" col-lg-1 col-md-1 col-sm-1">
                            &nbsp;REPLY
                        </div>
                    </div>
                </div>
                <!-- PINNED THREAD -->
                <div class="pinned-header">
                    <h4>>>PINNED THREAD</h4>
                </div>

                <div class="thread">

                    @foreach($posts['pinned'] as $post)
                    <!--PINNED POST-->
                    <div class="post pinned">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="post-img">
                                    <img src="images/mase.jpeg" class="img-circle img-small">
                                    <h5 class="img-name">{{ $post->user->name }}</h5>
                                </div>
                                <div class="post-header post-margin-top">{{ $post->title }}</div>

                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 post-margin-top">
                                15770
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 post-margin-top">
                                30
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 post-margin-top">
                                10
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 post-margin-top" style="margin-left: 0;padding-left: 0;">
                                14500
                            </div>

                        </div>
                    </div>

                    @endforeach





                </div>
                <!-- NORMAL THREAD -->
                <div class="normal-header">
                    <h4>>>NORMAL THREAD</h4>
                </div>
                @foreach($posts['normal'] as $post)
                <div class="post normal">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="post-img">
                                <img src="{{ asset('images/user.jpg') }}" class="img-circle img-small">
                                <h5 class="img-name">{{ $post->user->name }}</h5>
                            </div>
                            <div class="post-header post-margin-top">{{ $post->title }}</div>

                        </div>
                        <div class="col-lg-1 col-md-1  post-margin-top">
                            15770
                        </div>
                        <div class="col-lg-1 col-md-1  post-margin-top">
                            30
                        </div>
                        <div class="col-lg-1 col-md-1  post-margin-top">
                            10
                        </div>
                        <div class="col-lg-1 col-md-1  post-margin-top" style="margin-left: 0;padding-left: 0;">
                            14500
                        </div>

                    </div>

                </div>
                @endforeach
          >




            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="most-message">
                    <h3>Most messages</h3>
                    <ul>
                        <li>
                            <img src="{{ asset('images/user.jpg') }}" class="img-xsmall img-circle" style="float: left">
                            <div class="contents-side"><span class="name">Humud Abdulhussein</span><span class="number">126,577</span></div>
                        </li>

                        <li>
                            <img src="{{ asset('images/user.jpg') }}" class="img-xsmall img-circle" style="float: left">
                            <div class="contents-side"><span class="name">Humud Abdulhussein</span><span class="number">126,577</span></div>
                        </li>

                        <li>
                            <img src="{{ asset('images/user.jpg') }}" class="img-xsmall img-circle" style="float: left">
                            <div class="contents-side" ><span class="name">Humud Abdulhussein</span><span class="number">126,577</span></div>
                        </li>

                        <li>
                            <img src="{{ asset('images/user.jpg') }}" class="img-xsmall img-circle" style="float: left">
                            <div class="contents-side"><span class="name">Humud Abdulhussein</span><span class="number">126,577</span></div>
                        </li>

                        <li>
                            <img src="{{ asset('images/user.jpg') }}" class="img-xsmall img-circle" style="float: left">
                            <div class="contents-side"><span class="name">Humud Abdulhussein</span><span class="number">126,577</span></div>
                        </li>
                        <li>
                            <img src="{{ asset('images/user.jpg') }}"class="img-xsmall img-circle" style="float: left">
                            <div class="contents-side"><span class="name">Humud Abdulhussein</span><span class="number">126,577</span></div>
                        </li>

                    </ul>
                </div>
                @include('inc.right')
            </div>
        </div>

    </div>
    @endsection
