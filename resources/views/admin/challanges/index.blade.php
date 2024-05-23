@extends('layouts.admin')
@section('content')
<div style="margin:0 5px;" class="row d-flex justify-content-end">
    <div class="form col-md-6 ">
        <form action="{{ route('admin.challanges.index') }}" method="GET" id="form-status" class="">
            <div class="row justify-content-end">
                <div class="select w-25">
                    <select class="form-control" name="user">
                        <option value="">Select User</option>
                        @forelse ($users as $user)
                        <option value="{{$user->id}}" {{(request()->user == $user->id)?'selected':''}}>
                            {{$user->name}}</option>
                        @empty
                        <option value="">No user found</option>
                        @endforelse
                    </select>
                </div>
                <div class="select w-25">
                    <select class="form-control " name="createdby">
                        <option value=""> Created By</option>
                        @forelse ($users as $user)
                        <option value="{{$user->id}}" {{(request()->createdby == $user->id)?'selected':''}}>
                            {{$user->name}}</option>
                        @empty
                        <option value="">No user found</option>
                        @endforelse

                    </select>
                </div>
                <div class="select w-25">
                    <select class="form-control" name="acceptedby">
                        <option value=""> Accepted By</option>
                        @forelse ($users as $user)
                        <option value="{{$user->id}}" {{(request()->acceptedby == $user->id)?'selected':''}}>
                            {{$user->name}}</option>
                        @empty
                        <option value="">No user found</option>
                        @endforelse
                    </select>
                </div>

                <div class="select">
                    <select class="form-control" name="status">
                        <option value=""> Select Status</option>
                        <option value="challange_created" {{(request()->status == 'challange_created')?'selected':''}}>
                            Challange Created</option>
                        <option value="accepted" {{(request()->status == 'accepted')?'selected':''}}>Accepted</option>
                        <option value="complete" {{(request()->status == 'complete')?'selected':''}}>Complete</option>
                        <option value="cancel" {{(request()->status == 'cancel')?'selected':''}}>Cancel</option>
                        <option value="in_review" {{(request()->status == 'in_review')?'selected':''}}>In review
                        </option>
                        <option value="running" {{(request()->status == 'running')?'selected':''}}>Running
                        </option>
                    </select>
                </div>
            </div>

        </form>
    </div>
    <!-- <div class="addbtn">
        <a class="btn btn-sm btn-success" href="{{ route('admin.challanges.create') }}">
            Create Challagne
        </a>
    </div> -->
    <div class="refresh">
        <a href="{{url('dashboard/challanges')}}" class="btn btn-xs btn-info">Refresh</a>
    </div>

</div>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ isset($title)?$title:'' }}
        </h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>SN</th>
                        <!-- <th>{{ __('cruds.user.fields.name') }}</th> -->
                        <th>Created By</th>
                        <th>Accepted By</th>
                        <th dataa-shortable="false">Winner</th>
                        <th dataa-shortable="false">Creator Result</th>
                        <th dataa-shortable="false">Acceptor Result</th>
                        <th dataa-shortable="false">Amount</th>
                        <th dataa-shortable="false">Status</th>
                        <th dataa-shortable="false">
                            {{ __('global.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                    @forelse ($data as $key => $value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <!-- <td>{{$value->challenge_name??'-'}}</td> -->
                        <td>@if(!empty($value->c_name)) <a href="{{url('dashboard/users/'.$value->challenge_created_by)}}"> <b>{{$value->c_name??'-'}}</b> </a> @else - @endif</td>
                        <td>@if(!empty($value->a_name)) <a href="{{url('dashboard/users/'.$value->challenge_accepted_by)}}"> <b>{{$value->a_name??'-'}}</b> </a> @else - @endif</td>
                        <td>{{($value->who_win == $value->challenge_created_by)?$value->c_name:''}}
                            {{($value->who_win == $value->challenge_accepted_by)?$value->a_name:''}}</td>
                        <td>@if(!empty($value->creator_action))  {{$value->creator_action??'-'}} @elseif($value->cencal_creator=='1') Cancel @endif</td>
                        <td>@if(!empty($value->acceptor_action)) {{$value->acceptor_action??'-'}}  @elseif($value->cencal_acceptor=='1') Cancel @endif</td>
                        <td>{{$value->amount??''}}</td>
                        <td>{{ucfirst(str_replace("_"," ",$value->status))??'-'}}</td>
                        <td>
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.challanges.show', $value->id) }}">VIEW</a>
                            @can('permission_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.challanges.edit', $value->id) }}">EDIT
                            </a>
                            @endcan
                            @can('permission_delete')
                            <form action="{{ route('admin.challanges.destroy', $value->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this Challange');"
                                style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-xs btn-danger" value="">DELETE</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-danger">No data found</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
            {{$data->withQueryString()->links()}}

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection