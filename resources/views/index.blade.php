@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <img src="/avatars/{{ $user->avatar }}" style="width:100px; height:100px; border-radius:50%;float:left;" alt="User avatar">
                    <h3>{{ $user->name }}'s Profile</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('user.update', $user) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <legend>Choose avatar</legend>
                        <fieldset class="form-group">
                            @foreach ($avatarList as $avatar)
                                <label>
                                    <input type="hidden" class="form-control" name="username" value="{{ $user->name }}">
                                    <input type="hidden" class="form-control" name="email" value="{{ $user->email }}">
                                    <input type="radio" value="{{ $avatar }}" name="avatar-radio">
                                    <img src="/avatars/{{ $avatar }}" style="width:50px; height:50px; border-radius:50%;" alt="Avatar">
                                </label>
                            @endforeach
                        </fieldset>
                        <button type="submit" class="btn btn-secondary">Change avatar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
