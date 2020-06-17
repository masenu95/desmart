@extends('layouts.forum')

@section('content')
<div class="container">
        <div class="header-forum">
            <span class="header-path">
                <a href="{{ url('/Investment') }}" style="color:black">Smart investor>></a>Search result
            </span>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="post-title">
                    <div class="row">
                        <div class=" col-lg-8 col-md-8">
                            TITLE
                        </div>
                        <div class=" col-lg-1 col-md-1">
                            VIEWS
                        </div>
                        <div class=" col-lg-1 col-md-1">
                            LIKES
                        </div>
                        <div class=" col-lg-1 col-md-1">
                            DISLIKES
                        </div>
                        <div class=" col-lg-1 col-md-1">
                            &nbsp;REPLY
                        </div>
                    </div>
                </div>
                <!-- NORMAL THREAD -->
                <div class="normal-header">
                    <h4>>>SEARCH RESULT</h4>
                </div>

                @foreach($results as $result)
                <div class="post normal">
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <div class="post-img">
                                <img src="{{ asset('images/user.jpg') }}" class="img-circle img-small">
                                <h5 class="img-name">{{ $result->user->name }}</h5>
                            </div>
                            <div class="post-header post-margin-top">{{ $result->title }}</div>

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






            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="most-message">
                    <h3>Most messages</h3>
                    <ul>
                        <li>
                            <img src="images/humudi.jpg" class="img-xsmall img-circle float-left">
                            <div class="contents-side"><span class="name">Humud Abdulhussein</span><span class="number">126,577</span></div>
                        </li>

                        <li>
                            <img src="images/humudi.jpg" class="img-xsmall img-circle float-left">
                            <div class="contents-side"><span class="name">Humud Abdulhussein</span><span class="number">126,577</span></div>
                        </li>

                        <li>
                            <img src="images/humudi.jpg" class="img-xsmall img-circle float-left">
                            <div class="contents-side"><span class="name">Humud Abdulhussein</span><span class="number">126,577</span></div>
                        </li>

                        <li>
                            <img src="images/humudi.jpg" class="img-xsmall img-circle float-left">
                            <div class="contents-side"><span class="name">Humud Abdulhussein</span><span class="number">126,577</span></div>
                        </li>

                        <li>
                            <img src="images/humudi.jpg" class="img-xsmall img-circle float-left">
                            <div class="contents-side"><span class="name">Humud Abdulhussein</span><span class="number">126,577</span></div>
                        </li>
                        <li>
                            <img src="images/humudi.jpg" class="img-xsmall img-circle float-left">
                            <div class="contents-side"><span class="name">Humud Abdulhussein</span><span class="number">126,577</span></div>
                        </li>

                    </ul>
                </div>
                @include('inc.right')
            </div>
        </div>

    </div>
    @endsection
