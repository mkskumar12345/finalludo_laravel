@extends('layouts.admin')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ isset($title)?$title:'' }}
        </h4>
    </div>
    <br>
    <div class="card-body">
        <form action="{{ route("admin.users.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{(isset($user))?$user->id:'2'}}" name="roles[]">
            <input type="hidden" value="{{(isset($user))?$user->id:''}}" name="id">
            <div class="row">
                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">{{ __('cruds.user.fields.name') }}*</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                        @if($errors->has('name'))
                            <p class="help-block">
                                {{ $errors->first('name') }}
                            </p>
                        @endif
                        <p class="helper-block">
                            {{ __('cruds.user.fields.name_helper') }}
                        </p>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                        <label for="phone">{{ __('cruds.user.fields.phone') }}*</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', isset($user) ? $user->phone : '') }}" required>
                        @if($errors->has('phone'))
                            <p class="help-block">
                                {{ $errors->first('phone') }}
                            </p>
                        @endif
                        <p class="helper-block">
                            {{ __('cruds.user.fields.phone_helper') }}
                        </p>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">{{ __('cruds.user.fields.email') }}*</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" >
                        @if($errors->has('email'))
                            <p class="help-block">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                        <p class="helper-block">
                            {{ __('cruds.user.fields.email_helper') }}
                        </p>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">{{ __('cruds.user.fields.password') }}</label>
                        <input type="password" id="password" name="password" class="form-control">
                        @if($errors->has('password'))
                            <p class="help-block">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                        <p class="helper-block">
                            {{ __('cruds.user.fields.password_helper') }}
                        </p>
                    </div>
                </div>

                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('wallet') ? 'has-error' : '' }}">
                        <label for="wallet">{{ __('global.wallet') }}*</label>
                        <input type="text" min="0" id="wallet" name="wallet" class="form-control" value="{{ old('wallet', isset($user) ? $user->wallet : '') }}" disabled>
                        @if($errors->has('wallet'))
                            <p class="help-block">
                                {{ $errors->first('wallet') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('deposit_amount') ? 'has-error' : '' }}">
                        <label for="deposit_amount">Deposit Amount*</label>
                        <input type="text" min="0" id="wallet" name="deposit_amount" class="form-control" value="{{ old('wallet', isset($user) ? $user->deposit_amount : '') }}" disabled>
                        @if($errors->has('deposit_amount'))
                            <p class="help-block">
                                {{ $errors->first('deposit_amount') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('profile_image') ? 'has-error' : '' }}">
                        <label for="profile_image">{{ __('global.profile_image') }}</label>
                        <input type="file" style="opacity: 1 !important; position: revert;" id="profile_image" name="profile_image" class="form-control" >
                    </div>
                    @isset($user->profile_image)<img src="{{url($user->profile_image)}}" width="75" height="75" class="imageimg-thumbnail rounded mt-2"> @endif
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label for="phone">Status*</label>
                        <select name="status" class="form-control" required>
                            <option value="">Select status </option>
                            <option value="approve" {{isset($user)?($user->status == 'approve'?'selected':''):''}}>Acitve</option>
                            <option value="pending" {{isset($user)?($user->status == 'pending'?'selected':''):''}}>Pending</option>
                            <option value="block" {{isset($user)?($user->status == 'block'?'selected':''):''}}>Block</option>
                        </select>
                        @if($errors->has('status'))
                            <p class="help-block">
                                {{ $errors->first('status') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label for="phone">Status*</label>
                        <select name="permission[]" class="form-control select2" multiple >
                            @foreach($permissionArray as $item)
                            <option value="{{$item}}"  {{ in_array($item,$UserPermisssions) ? 'selected' : '' }}>{{$item}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('status'))
                            <p class="help-block">
                                {{ $errors->first('status') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('is_play') ? 'has-error' : '' }}">
                        <label for="phone">Is Able To Play*</label>
                        <select name="is_play" class="form-control" required>
                            <option value="1" {{isset($user)?($user->is_play == 1?'selected':''):''}}>Yes</option>
                            <option value="0" {{isset($user)?($user->is_play == 0?'selected':''):''}}>No</option>
                        </select>
                        @if($errors->has('is_play'))
                            <p class="help-block">
                                {{ $errors->first('is_play') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <br>
                <input class="btn btn-success" type="submit" value="{{ __('global.save') }}">
            </div>
        </form>
    </div>
</div>
<script>
    $(".select2").select2();
</script>
@endsection
