@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                    <span class="float-right"> <a href="{{route('table')}}">{{ __('View Table') }}</a></span>
                </div>
               
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('upload-json') }}" enctype="multipart/form-data">
                        @csrf
                        @if ($msg = Session::get('success'))
                            <div class="alert alert-success">
                                <strong>{{ $msg }}</strong>
                            </div>
                        @endif
                        @if ($msg = Session::get('error'))
                            <div class="alert alert-danger">
                                <strong>{{ $msg }}</strong>
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Upload JSON File') }}</label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control" name="jsonfile" required autofocus>                               
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
