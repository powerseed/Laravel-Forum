@extends('layouts.app')
@section('title', 'Edit profile')
@section("content")
    <div class="container">
        <div class="col-lg-6 offset-3">
            <div class="card">
                <div class="card-header">
                    <h3>Edit profile</h3>
                </div>
                <div class="card-body">
                    @include('shared._errors')
                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">User name</label>
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Personal introduction</label>
                            <textarea name="introduction" class="form-control" id="exampleFormControlTextarea1" rows="3" value="{{ old('introduction', $user->introduction) }}"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input type="file" name="avatar" class="form-control-file" id="avatar">
                        </div>

                        <button type="submit" class="btn-primary btn">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
