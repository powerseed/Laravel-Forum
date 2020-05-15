@extends('layouts.app')
@section('title', isset($category)?$category->name:'Topics')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-1">
                @if(isset($category))
                    <div class="alert alert-primary">
                        {{ $category->name}}: {{ $category->description}}.
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <a class="btn {{ (request()->query('order') == 'last_replied') ? 'btn-primary' : '' }}" href="{{request()->url()}}?order=last_replied">Last replied</a>
                        <a class="btn {{ (request()->query('order') == 'last_posted') ? 'btn-primary' : '' }}" href="{{request()->url()}}?order=last_posted">Last posted</a>
                        <a href="{{ route('topics.create') }}" class="btn btn-success float-right">
                            <i class="fas fa-edit mr-1"></i>
                            Create a new topic
                        </a>
                    </div>
                    @include('shared._topics', ['topics' => $topics])

                    <div class="mt-2 align-self-center">
                        {!! $topics->appends(Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
