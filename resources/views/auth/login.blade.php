@extends('layouts.app')
@section('content')

<div class="wrapper wrapper-full-page">
    <div class="page-header login-page header-filter">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center t-image">
                @php $logo = App\SiteSetting::where('name','logo')->pluck('value')->first(); @endphp
                <img src="{{url('/assets/logo/'.$logo)}}" height="100" width="100">
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-8 ml-auto mr-auto t-image">
                    <div class="card card-login mb-3">
                        <div class="card-header card-header-primary text-center">
                            <h4 class="card-title">
                                <strong>Admin Login</strong>
                            </h4>
                        </div>
                        <div class="card-body login-card-body">
                            @if(\Session::has('message'))
                                <p class="alert alert-info">
                                    {{ \Session::get('message') }}
                                </p>
                            @endif

                            <form action="{{ route('login') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}">
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}" name="password">
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="card-footer justify-content-center" style="padding-top: 35px;">
                                    <button type="submit" class="btn btn-primary">{{ trans('global.login') }}</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.login-card-body -->
                    </div>
         
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.card .card-body .form-group {
    margin: 15px 0 0;
}
.form-control {
    height: 45px;
}
</style>
@endsection
