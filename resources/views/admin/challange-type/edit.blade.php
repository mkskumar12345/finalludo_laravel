@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.challange-type.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{isset($type)?$type->id:''}}">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Challange Type note*</label>
                <input type="text" id="type" name="name" class="form-control" value="{{ old('type', isset($type) ? $type->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
          
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">Challange Description*</label>
                <input type="text" id="type" name="description" class="form-control" value="{{ old('type', isset($type) ? $type->description : '') }}" required>
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
          
            </div>
            <div class="form-group mb-3 ">
                        <label class="form-label" for="logo">Select Logo</label>
                        <input type="file" id="logo" name="logo" placeholder="logo" class="form-control">
                        </div>
           
            
         
            <div>
                <div class="form-group">
                @if(isset($type) && !empty($type->image)) <img class="image mt-2" src="{{url('/assets/logo/'.$type->image)}}" width="120">            @endif            
                </div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection
