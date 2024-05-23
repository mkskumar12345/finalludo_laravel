@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row d-flex">
        <div class="col-lg-6">
            <a class="btn btn-sm btn-success" href="{{ route('admin.challanges.create') }}">
                Create Challagne
            </a>
        </div>
        <div class="col-lg-6">
            <form action="{{ route('admin.challanges.index') }}" method="GET" id="form-status" class="">
                <div class="d-flex">
                <a href="{{url('dashboard/challanges')}}" class="btn btn-sm btn-info">Refresh</a>
                <select class="form-control position-absolute w-25" style="right: 0;" name="status">
                    <option value=""> Select status</option>
                    <option value="challange_created" {{(request()->status == 'challange_created')?'selected':''}}> Challange Created</option>
                    <option value="accepted" {{(request()->status == 'accepted')?'selected':''}}>Accepted</option>
                    <option value="on_play" {{(request()->status == 'on_play')?'selected':''}}>On Play</option>
                    <option value="complete" {{(request()->status == 'complete')?'selected':''}}>Complete</option>
                    <option value="drow" {{(request()->status == 'drow')?'selected':''}}>Drow</option>
                    <option value="cancel" {{(request()->status == 'cancel')?'selected':''}}>Cancel</option>
                    <option value="in_review" {{(request()->status == 'in_review')?'selected':''}}>In review</option>
                </select>
                </div>
            </form>
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
            <table class=" table table-striped table-hover datatable datatable-challanges">
                <thead>
                    <tr>
                        <th>{{ __('cruds.user.fields.id') }}</th>
                        <th>{{ __('cruds.user.fields.name') }}</th>
                        <th>Created By</th>
                        <th>Accepted By</th>
                        <th dataa-shortable="false">Winner</th>
                        <th dataa-shortable="false">Status</th>
                        <th dataa-shortable="false">
                            {{ __('global.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->challenge_name??'-'}}</td>
                        <td>{{$value->c_name??'-'}}</td>
                        <td>{{$value->a_name??'-'}}</td>
                        <td>{{(($value->who_win== $value->challenge_created_by)?$value->c_name:$value->a_name)??'-'}}</td>
                        <td>{{ucfirst(str_replace("_"," ",$value->status))??'-'}}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.challanges.show', $value->id) }}">VIEW</a>
                            @can('permission_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.challanges.edit', $value->id) }}">EDIT </a>
                            @endcan
                            @can('permission_delete')
                            <form action="{{ route('admin.challanges.destroy', $value->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Challange');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-xs btn-danger" value="">DELETE</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">No data found</td>
                    </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection

