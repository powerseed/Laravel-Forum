@extends('layouts.app')
@section('title', 'Create Topic')
@section('content')
    <div class="container">
        <div class="col-lg-9 offset-2">
            <div class="card">
                <div class="card-header">
                    <h3>
                        <i class="fas fa-edit mr-1"></i>
                        Create a new topic
                    </h3>
                </div>
                <div class="card-body">
                    @include('shared._errors')
                    <form method="POST" action="{{ route('topics.store') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Please enter the title" value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            <select name="category_id" class="form-control" value="{{ old('category_id') }}">
                                <option selected disabled>Please choose a category</option>
                                @foreach($categories as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <textarea name="body" id="editor" class="form-control" placeholder="Please enter content longer than 3 characters" rows="5">{{ old('body') }}</textarea>
                        </div>
                        <button type="submit" class="btn-primary btn">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/simditor.js') }}"></script>

    <script>
        $(document).ready(function ()
        {
            Simditor.locale = 'en-US';
            var editor = new Simditor(
                {
                    textarea: $('#editor'),
                    upload: {
                        url: '{{ route('topics.upload_image') }}',
                        params: {
                            _token: '{{ csrf_token() }}'
                        },
                        fileKey: 'upload_file',
                        connectionCount: 3,
                        leaveConfirm: 'Uploading is in progress, are you sure to leave this page?'
                    },
                    pasteImage: true
                });
        })
    </script>
@stop
