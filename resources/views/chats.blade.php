@extends('layouts.app')

@section('content')
<div class="container">
    <chats-component :user="{{ auth()->user() }}"></chats-component>
</div>
<div class="container">
    <Canvas-component :user="{{ auth()->user() }}"></Canvas-component>
</div>
@endsection
