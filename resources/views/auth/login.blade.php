@extends('layouts.auth-main')

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('message')}}
        </div>
    @endif
<div class="p-2">
    <form class="form-horizontal" action="{{ route('authenticate') }}" method="POST">
    @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group auth-pass-inputgroup">
                <input type="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" name="password">
                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
            </div>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="remember-check">
            <label class="form-check-label" for="remember-check">
                Remember me
            </label>
        </div>
        <div class="mt-3 d-grid">
            <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
        </div>
        <div class="mt-4 text-center">
            <a href="{{ route('forget-password') }}" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
        </div>
    </form>
</div>
@endsection
