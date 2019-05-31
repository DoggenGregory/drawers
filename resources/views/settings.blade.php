@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Settings</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="{{ $userdb->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $userdb->email }}">
                        </div>
                        <div class="form-group">
                            <label for="oldpw">Old password</label>
                            <input type="password" class="form-control" name="oldpw">
                        </div>
                        <div class="form-group">
                            <label for="newpw">New password</label>
                            <input type="password" class="form-control" name="newpw">
                        </div>
                        <div class="form-group">
                            <label for="newpw_confirm">Confirm new password</label>
                            <input type="password" class="form-control" name="newpw_confirm">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary" name="settings-btn">Submit changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
