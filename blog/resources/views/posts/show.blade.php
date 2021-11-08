@extends('layouts.layout')

@section('title', 'Show post')
@section('content')
    <div style="background-color: whitesmoke; margin:10px 5px 10px 5px;">
    <h2>{{ $post->title }}</h2>
    <img style="padding:30px; max-width:50%;"  src="{{asset('storage/images/posts/'. $post->image)}}" alt="">
    <p style="margin:20px">{{ $post->content }}</p>

    {{--    @foreach($comments as $comment)--}}
    {{--        <h3>{{$comment->user->name}}</h3>--}}
    {{--        <p>{{$comment->text}}</p>--}}
    {{--    @endforeach--}}

    <ol class="list-group" style=" margin:10px 15px 10px 15px;">
        @foreach($comments as $comment)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">{{$comment->user->name}}</div>
                    {{$comment->text}}
                </div>
                @can('delete', $comment)
                    <form action="{{route('comments.destroy', $comment->id)}}" method="post" style=" margin:10px 15px 10px 15px;" >
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-close"></button>
                    </form>

                @endcan

            </li>
        @endforeach
    </ol>

    <form action="{{route('comments.store')}}" method="post" class="mt-5">
        @csrf
        <textarea class="form-control" name="text" cols="30" rows="3"></textarea>
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <button class="btn btn-warning mt-2">{{__('welcome.comment')}}</button>
    </form>
@endsection
    </div>
