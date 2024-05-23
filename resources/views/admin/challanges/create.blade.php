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
        <form action="{{ route("admin.challanges.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{isset($challange)?$challange->id:''}}">
            <div class="row">
                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Challange Name*</label>
                        <input type="text" name="challange_name" class="form-control"
                            value="{{ old('challange_name', isset($challange) ? $challange->challenge_name : '') }}" required>
                        @if($errors->has('challange_name'))
                        <p class="help-block">
                            {{ $errors->first('challange_name') }}
                        </p>
                        @endif
                        <p class="helper-block">
                            {{ __('cruds.user.fields.name_helper') }}
                        </p>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('created_by') ? 'has-error' : '' }}">
                        <label for="phone">Challange Created By*</label>
                        <select name="created_by" class="form-control" required>
                            <option value="">Select challange user</option>
                            @forelse ($users as $player)
                            <option value="{{$player->id}}" {{$player->id}}" {{ isset($challange)?($challange->challenge_created_by == $player->id ? 'selected' : ''):'' }}>{{$player->name}}</option>
                            @empty
                            <option value="">No user found</option>
                            @endforelse
                        </select>
                        @if($errors->has('created_by'))
                        <p class="help-block">
                            {{ $errors->first('created_by') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('accepted_by') ? 'has-error' : '' }}">
                        <label for="email">Accepted By*</label>
                        <select name="accepted_by" class="form-control" >
                            <option value="">Select Accepted user</option>
                            @forelse ($users as $player)
                            <option value="{{$player->id}}" {{ isset($challange)?($challange->challenge_accepted_by == $player->id ? 'selected' : ''):'' }} >{{$player->name}}</option>
                            @empty
                            <option value="">No user found</option>
                            @endforelse
                        </select>
                        
                        @if($errors->has('accepted_by'))
                        <p class="help-block">
                            {{ $errors->first('accepted_by') }}
                        </p>
                        @endif
                    </div>
                </div>

                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label for="email">Status*</label>
                        <select name="status" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="challange_created" @if(isset($challange) && $challange->status=='challange_created') selected @endif>Challange created</option>
                            <option value="accepted" @if(isset($challange) && $challange->status=='accepted') selected @endif>Accepted</option>
                            
                            <option value="complete" @if(isset($challange) && $challange->status=='complete') selected @endif>Complete</option>
                          
                            <option value="cancel" @if(isset($challange) && $challange->status=='cancel') selected @endif>Cancel</option>
                            <option value="in_review" @if(isset($challange) && $challange->status=='in_review') selected @endif>In review</option>
                        </select>
                        @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                        @endif
                       
                    </div>
                </div>
            
                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                        <label for="email">Challange Type*</label>
                        <select name="type" class="form-control" required>
                            <option value="">Select Accepted user</option>
                            @forelse ($type as $val)
                            <option value="{{$val->id}}" {{ isset($challange)?($challange->challenge_type == $val->id ? 'selected' : ''):'' }} >{{$val->name}}</option>
                            @empty
                            <option value="">No user found</option>
                            @endforelse
                        </select>
                        @if($errors->has('type'))
                        <p class="help-block">
                            {{ $errors->first('type') }}
                        </p>
                        @endif
                       
                    </div>
                </div>

                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                        <label for="wallet">Amount*</label>
                        <input type="number" min="0" id="amount" name="amount" class="form-control"
                            value="{{ old('amount', isset($challange) ? $challange->amount : '') }}" required>
                        @if($errors->has('amount'))
                        <p class="help-block">
                            {{ $errors->first('amount') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('winner_amount') ? 'has-error' : '' }}">
                        <label for="wallet">Winner Amount*</label>
                        <input type="number" min="0" id="winner_amount" name="winner_amount" class="form-control"
                            value="{{ old('winner_amount', isset($challange) ? $challange->winning_amount : '') }}">
                        @if($errors->has('winner_amount'))
                        <p class="help-block">
                            {{ $errors->first('winner_amount') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('room_code') ? 'has-error' : '' }}">
                        <label for="wallet">Room Code</label>
                        <input type="number" min="0" id="room_code" name="room_code" class="form-control"
                            value="{{ old('room_code', isset($challange) ? $challange->room_code : '') }}">
                        @if($errors->has('room_code'))
                        <p class="help-block">
                            {{ $errors->first('room_code') }}
                        </p>
                        @endif
                    </div>
                </div>

                <div class="col-6 col-md-6">
                    <div class="form-group {{ $errors->has('screenshort') ? 'has-error' : '' }}">
                        <label for="screenshort">Screenshort</label>
                        <input type="file" style="opacity: 1 !important; position: revert;" id="screenshort"
                            name="screenshort" class="form-control">
                    </div>
                    @isset($challange->screenshort)<img src="{{ url('/assets/winnershort').'/'.$challange->screenshort ?? "" }}" width="75" height="75"
                        class="imageimg-thumbnail rounded mt-2"> @endif
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