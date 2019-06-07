@extends('layouts.app')

@section('content')
<div class="container">
    <drawing-board :user="{{ auth()->user() }}"></drawing-board>
    <chats-component :user="{{ auth()->user() }}"></chats-component>
</div>
@endsection
