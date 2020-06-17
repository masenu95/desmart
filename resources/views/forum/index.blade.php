@extends('layouts.forum')

@section('content')

    <!-- head -->
    <div id="forum-content">

        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="tab">
                        <div class="center-item">
                            <button class="tablinks" onclick="openPost(event, 'Trending')" id="defaultOpen">Trending</button>
                            <button class="tablinks" onclick="openPost(event, 'Recent')">Recent</button>
                        </div>
                    </div>

                    <div id="Trending" class="tabcontent">
                        <div class="content-one-main">

                            @foreach ($trends as $trend)

                            <div class="content-one-main-all">
                                <div class="content-one-main-one">
                                    <img src="images/icons8_play_52px.png" alt="">
                                    <a href="{{ url('Post/'.$trend->id) }}">
                                        <p>{{ $trend->post->title }}</p>
                                    </a>
                                </div>

                                <div class="content-one-main-two">
                                    <a href="">
                                        <h4>{{ $trend->post->fcategory->name }}</h4>
                                    </a>
                                </div>

                                <div class="content-one-main-three">
                                    <img src="{{ asset('images/user.jpg') }}" alt="">
                                    <p>{{ $trend->post->user->name }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>


                    <div id="Recent" class="tabcontent">
                        <div class="content-one-main">
                          @foreach ($recents as $recent)
                          <div class="content-one-main-all">
                            <div class="content-one-main-one">
                                <img src="images/icons8_play_52px.png" alt="">
                                <a href="{{ url('Post/'.$recent->id) }}">
                                    <p>{{ $recent->title }}</p>
                                </a>
                            </div>

                            <div class="content-one-main-two">
                                <a href="">
                                    <h4>{{ $recent->fcategory->name  }}</h4>
                                </a>
                            </div>

                            <div class="content-one-main-three">
                                <img src="{{ asset('images/user.jpg') }}" alt="">
                                <p>{{ $recent->user->name }}</p>
                            </div>
                        </div>
                          @endforeach

                        </div>
                    </div>

                    <div class="forum-main-header">DISCUSSION ROOM</div>
                    <div class="row forum-link">
                    @foreach($categories as $category)
                        <div class="col-lg-6 col-md-6 col-sm-12">

                            <a href="{{ url('Investment/'.$category->id) }}">
                                <div class="forum-card">
                                    <div class="row">


                                            <h4>{{$category->name}}</h4>
                                            <p>{{ $category->caption }}</p>


                                    </div>

                                </div>
                            </a>
                        </div>
                    @endforeach
                     </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="staff-online">
                        <h3>STAFF ONLINE</h3>
                        <ul>
                            @foreach ($staffs as $staff)
                                <li>
                                    <img src="{{ asset('images/user.jpg') }}" class="img-xsmall img-circle" style="float:left">
                                    <div class="contents-side">
                                        <h5 class="name">{{ $staff->name }}</h5>
                                        <div class="posit">{{ $staff->role->name }}</div>
                                    </div>
                                </li>
                                <hr>
                            @endforeach

                        </ul>
                    </div>
                    @include('inc.right')


                </div>
            </div>
        </div>
    </div>

@endsection
