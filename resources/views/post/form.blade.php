@extends('layout')

@section('form')
    <div class="container">
        <div class="row">
            <div class="col-sm-5" style="margin-top:20px">
                <h3>{{ 'Post Create' }}</h3>
                <form action="@if($isCreate) {{route('posts.store')}} @else {{route('posts.update')}} @endif"
                      method="post">
                    @csrf
                    @if(!$isCreate)
                        <input type="hidden" id="id" name="id" value="{{ $post->id }}">
                    @endif
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" id="title" name="title"
                               value="{{ ($post->title && !$errors->has('title') ? $post->title : old('title')) }}">
                        @if($errors->has('title'))
                            @foreach($errors->get('title') as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endisset
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Body:</label>
                        <textarea class="blog_message form-control" id="body" name="body">{{ $post->body }}</textarea>
                        @if($errors->has('body'))
                            @foreach($errors->get('body') as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endisset
                    </div>
                    <div class="mb-3">
                        <input type="hidden" value="{{$users->id}}" name="user_id" id="user_id">
                    </div>
                    <a href="{{route('post')}}"
                       class="btn btn-outline-primary">
                        {{ __('Back') }}
                    </a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>
    </div>
@endsection
