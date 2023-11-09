@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center" style="margin-top: 20px">
                <h4>{{ $post->title }}</h4>
                <hr>
                <p>{{ $post->body }}</p>
                <a href="{{route('post')}}"
                   class="btn btn-outline-primary">
                    {{ __('Back') }}
                </a>
            </div>
        </div>
    </div>
@endsection

