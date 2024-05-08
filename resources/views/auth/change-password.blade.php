@extends('layouts.auth-main')

@section('content')

    @if (Session::has('message'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('message')}}
        </div>
    @endif

<div class="p-2">
    <div class="alert alert-success text-center mb-4" role="alert">
        Enter your Email and instructions will be sent to you!
    </div>
    <form class="form-horizontal" action="index.html">

        <div class="mb-3">
            <label for="useremail" class="form-label">Password</label>
            <input type="email" class="form-control" id="useremail" placeholder="Enter email">
        </div>

        <div class="text-end">
            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
        </div>
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-muted"><i class="mdi mdi-lock me-1"></i> Back to login?</a>
        </div>
    </form>
</div>
@endsection
