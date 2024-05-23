@extends('layouts.frontend')
@section('content')
<div class="bg-light text-dark card-header"style="text-align: center;">Forget Password</div>
      <div class="card-body ">
      <form method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <div>
                    <input name="token" value="{{ $token }}" type="hidden">
                    <div class="form-group has-feedback">
                        <input type="email" name="email" class="form-control" value="{{ app('request')->input('email') }}" required placeholder="{{ trans('global.login_email') }}">
                        @if($errors->has('email'))
                            <p class="text-danger">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" required placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                            <p class="text-danger">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
                        @if($errors->has('password_confirmation'))
                            <p class="text-danger">
                                {{ $errors->first('password_confirmation') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ trans('global.reset_password') }}
                        </button>
                    </div>
                </div>
            </form>
      </div>
   </div>
@endsection