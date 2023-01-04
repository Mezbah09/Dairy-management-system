@extends('admin.layouts.app')
@section('title','Super Admin Login')
@section('head-title','Super Admin Login')
@section('toobar')
@endsection
@section('content')


<form action="{{route('super-password')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body text-black">
                    <h2>
                        Super Admin Login
                    </h2>
                    <hr>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">
                            Login
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</form>




@endsection
@section('js')

@endsection
