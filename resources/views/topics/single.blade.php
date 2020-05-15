@extends('layouts.app')
@section('title', 'LaraBBS')
@section('content')
    <div class="container col-lg-9">
        <div class="card">
            <div class="card-body topic">
                <div class="text-center">
                    <h2>{{ $topic->title }}</h2>
                    <a href="{{ route('users.show', $user) }}">{{$user->name}}</a>
                     ·
                    <span>{{ $topic->created_at->diffForHumans() }}</span>
                     ·
                    <span>
                        <i class="far fa-comment-dots"></i>
                        {{$topic->reply_count}}
                    </span>
                </div>
                <br>
                {!! $topic->body !!}

                @if($topic->user_id == \Illuminate\Support\Facades\Auth::id())
                    <hr>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('topics.edit', $topic) }}">
                        <i class="far fa-edit"></i>
                        Edit
                    </a>
                    <form action="{{ route('topics.destroy', $topic) }}" method="POST" style="display: inline-block">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="url" value="{{ url()->previous() }}">
                        @csrf
                        <button class="btn btn-outline-secondary btn-sm" type="submit">
                            <i class="far fa-trash-alt"></i>
                            Delete
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <li class="list-group-item">
                            @include('shared._errors')
                            <form action="{{ route('replies.store') }}" method="POST">
                                <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                                @csrf
                                <textarea name="content" id="content" cols="100" rows="4" placeholder="Please reply here...">{{ old('content') }}</textarea>
                                <button class="btn btn-primary" type="submit" style="display: block">Submit</button>
                            </form>
                        </li>
                    @endif

                    @foreach($replies as $reply)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-1 d-flex align-items-center justify-content-center">
                                    <img src="{{ $reply->user->avatar }}" alt="" style="height: 50px; width: 50px; border-radius: 10px">
                                </div>

                                <div class="col-lg-10">
                                    <a href="{{ route('users.show', $reply->user) }}" style="font-size: 20px">{{ $reply->user->name }}</a>
                                     ·
                                    <span>
                                        <i class="far fa-clock"></i>
                                        {{ $reply->created_at->diffForHumans() }}
                                    </span>

                                    <div class="mt-1">
                                        <span class="mr-2">
                                            {{ $reply->content }}
                                        </span>
                                    </div>
                                </div>

                                @can('delete', $reply)
                                    <div class="col-lg-1 d-flex justify-content-end">
                                        <form action="{{ route('replies.destroy', $reply->id) }}" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf
                                            <button type="submit" class="btn">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop
