@extends('layouts.app')
@section('title', 'User Center')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-2">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ $user->avatar }}" alt="Card image cap">
                <div class="card-body">
                    <h3 class="card-title">Introduction</h3>
                    <p class="card-text">{{$user->introduction}}</p>

                    <hr class="mt-3 mb-3"/>
                    <h3>Registered on</h3>
                    <p>{{$user->created_at->diffForHumans()}}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-8 offset-2">
            <div class="card">
                <div class="card-body">
                    <strong style="font-size: 22px">{{$user->name}}</strong>
                    <span>{{$user->email}}</span>
                </div>
            </div>

            <hr>

            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->query('tab') == '') ? 'active' : ''}}"
                               href="{{ route('users.show', $user->id) }}">
                                His/Her topics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->query('tab') == 'replies') ? 'active' : ''}}"
                               href="{{ route('users.show', ['user' => $user,'tab' => 'replies']) }}">
                                His/Her replies
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @if(request()->query('tab') == '')
                            @foreach($topics as $topic)
                                <li class="list-group-item">
                                    <a class="float-left" href="">{{ $topic->title }}</a>
                                    <div class="float-right">
                                        <span>{{ $topic->reply_count }} replies</span>
                                        <span> · </span>
                                        <span>{{ $topic->created_at->diffForHumans() }}</span>
                                    </div>
                                </li>
                            @endforeach

                            <div class="mt-2">
                                {!! $topics->appends(Request::except('page'))->render() !!}
                            </div>
                        @elseif(request()->query('tab') == 'replies')
                            @foreach($replies as $reply)
                                <li class="list-group-item text-left">
                                    <div>
                                        <a href="{{ route('topics.show', $reply->topic) }}">{{ $reply->topic->title }}</a>
                                    </div>
                                    <div>{{ $reply->content }}</div>
                                    <div>
                                        <i class="far fa-clock"></i>
                                        Replied at {{ $reply->created_at->diffForHumans() }}
                                    </div>
                                </li>
                            @endforeach
                            <div class="mt-2">
                                {!! $replies->appends(Request::except('page'))->render() !!}
                            </div>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
