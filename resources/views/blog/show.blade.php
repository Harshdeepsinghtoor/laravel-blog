@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/blog" class="btn btn-outline-primary btn-sm">Go back</a><hr>
                {{-- onclick="javascript:history.back() --}}
                {{-- <button href="/blog" class="btn btn-outline-primary btn-sm">Go Back</button><hr> --}}
                @if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
@if(Session::has('create'))
<p class="alert alert-success">{{ Session::get('create') }}</p>
@endif
                
                
                <h1 class="display-one">{{ ucfirst($post->title) }}</h1>
                @if(isset($post->photo))
                <img src="{{URL::asset('/images/'.$post->photo)}}" class="rounded mx-auto d-block" alt="Can not show" height="300" width="300">
                @endif
                <p>{!! $post->body !!}</p> 
                {{-- CK Content Heres --}}
                {{-- @php
                    $content = $request->input('editor');
                @endphp
                <textarea class="form-control" id="editor" name="editor">{!! $content !!}</textarea> --}}

                {{-- CK Endings is Heres --}}
                <hr>
                <a href="/blog/{{ $post->id }}/edit" class="btn btn-outline-primary">Edit Post</a>
                <br><br>
                <form id="delete-frm" class="" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Are you sure ?')" >Delete Post</button>
                </form>
            </div>
        </div>
    </div>
@endsection