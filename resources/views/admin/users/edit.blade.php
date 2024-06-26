@extends('layouts.admin')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route("admin.users.update", [$user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.user.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.user.fields.email') }}*</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                @if($errors->has('email'))
                    <p class="help-block">
                        {{ $errors->first('email') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input type="password" id="password" name="password" class="form-control">
                @if($errors->has('password'))
                    <p class="help-block">
                        {{ $errors->first('password') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.password_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                <label for="roles">{{ trans('cruds.user.fields.roles') }}*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <p class="help-block">
                        {{ $errors->first('roles') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.roles_helper') }}
                </p>
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
                        <label for="phone">Permissions*</label>
                        <select name="permission[]" class="form-control select2" multiple required>
                            <!-- <option >Select Permissions </option> -->
                            @foreach($permissionArray as $item)
                            <option value="{{$item}}" selected {{ in_array($item,$UserPermisssions) ? 'selected' : '' }}>{{$item}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('status'))
                            <p class="help-block">
                                {{ $errors->first('status') }}
                            </p>
                        @endif
                    </div>
                </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
<script>
    $(".select2").select2();
</script>
@endsection
