@extends('layouts.app')

@section('content')
<div class="container">
    <chats-component :user="{{ auth()->user() }}"></chats-component>
    <canvas-component :user="{{ auth()->user() }}"></canvas-component>
</div>

@endsection
