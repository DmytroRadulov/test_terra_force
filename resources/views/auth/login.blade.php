@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-5" style="margin-top:20px">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <h3>{{ __('Login') }}</h3>
                <form action="{{route('auth.handleLogin')}}" method="POST">
                    @csrf
                    @if($errors->has('email'))
                        @foreach($errors->get('email') as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endisset
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    @if($errors->has('password'))
                        @foreach($errors->get('password') as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endisset
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <a href="{{route('register')}}"
                       class="btn btn-outline-primary">
                        {{ __('Sing Up') }}
                    </a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
