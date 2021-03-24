@extends('dashboard.layouts.app')

@section('dashboard.content')
    <div class="container">
            <div class="card mt-5">
                <div class="card-header">
                    <h3>Enter your credentials</h3>
                </div>
                <div class="card-body">
                    @include('dashboard.includes.errors')
                    <form action="{{ route('dashboard.login') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" name="email" id="email"  placeholder="Enter user email" required>
                        </div>
                        <div class="form-group">
                          <label for="passwrod">Password</label>
                          <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                      </form>
                </div>
            </div>
    </div>
@endsection