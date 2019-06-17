@extends('layouts.app')

@section('content')






<div class="container">

    <chats-component :user="{{ auth()->user() }}"></chats-component>
    <canvas-component :user="{{ auth()->user() }}"></canvas-component>


</div>

@endsection
<script>
    import DrawingSocket from "../js/components/DrawingSocket";
    export default {
        components: {DrawingSocket}
    }
</script>
<script>
    import CanvasComponent from "../js/components/CanvasComponent";
    export default {
        components: {CanvasComponent}
    }
</script>