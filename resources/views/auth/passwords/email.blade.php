@extends('layouts.frontend')
@section('content')
<div class="bg-light text-dark card-header"style="text-align: center;">Forget Password</div>
      <div class="card-body ">
        <form method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}
            <div>
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" required="autofocus" placeholder="{{ trans('global.login_email') }}">
                    @if($errors->has('email'))
                        <p class="help-block text-danger">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                    @if (session('status'))
                    <p class="help-block text-success">{{ session('status') }}</p>
                        @endif
                </div>
            </div>
            <div class="row">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat"style="width: 100%;">
                           Submit
                        </button>
                    </div>
                </div>
        </form>
      </div>
   </div>
@endsection