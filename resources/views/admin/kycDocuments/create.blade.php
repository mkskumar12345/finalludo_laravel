@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ isset($title)?$title:'' }}
        </h4>
    </div>
    <br>
    <div class="card-body">
        <form action="{{ route("admin.pages.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{(isset($page))?$page->id:'2'}}" name="roles[]">
            <input type="hidden" value="{{(isset($page))?$page->id:''}}" name="id">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">{{ __('cruds.user.fields.name') }}*</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($page) ? $page->name : '') }}" required>
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

                <div class="col-12 col-md-12">
                    <div class="form-group">
                        <label for="description">{{ __('global.description') }}*</label><br>
                        <textarea name="description" class="form-control ckeditor">{{ old('description', isset($page) ? $page->description : '') }}</textarea>
                    </div>
                </div>
                
                <div class="col-12 col-md-12">
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label for="status">{{ __('global.status') }}*</label>
                        <select id="status" name="status" class="form-control" value="{{ old('status', isset($page) ? $page->status : '') }}" required>
                            <option value="1" {{(isset($page) && $page->status)?'active':''}}>Active</option>
                            <option value="0" {{(isset($page) && !$page->status)?'active':''}}>In Active</option>
                        </select>
                        @if($errors->has('status'))
                            <p class="help-block">
                                {{ $errors->first('status') }}
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
@endsection
