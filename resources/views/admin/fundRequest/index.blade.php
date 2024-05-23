@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ isset($title)?$title:'' }}
        </h4>
    </div>

    <div class="card-body">
        <div class="table-responsive">
        <table class=" table table-striped table-hover datatable fund-request">
                <thead>
                    <tr>
                        <th>
                            {{ __('cruds.user.fields.id') }}
                        </th>
                        <th>
                            User Name
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                        is admin
                        </th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  
                    @forelse ($data as  $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td> <a href="{{url('dashboard/users/'.$value->user_id,)}}">{{$value->user_name}}</a> </td>
                            <td>{{$value->amount}}</td>
                            <td>{{date('d F Y h:i A',strtotime($value->created_at))}}</td>
                            <!-- <td>{{\Carbon\Carbon::parse($value->created_at)->format('d M, Y')}}  </td> -->
                            <td>{{$value->isAdmin=='1'?'Yes':'No'}}</td>
                            <td class="im_preview">@if($value->screen_shot)<img  src="{{url('assets/transaction',$value->screen_shot)}}" height="75" width="75">@endif</td>
                            <td>
                                <div class="d-flex">
                                @if($value->deposit_status == 'Pending')
                                <form method="post" action="{{route('admin.fund-request.store')}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$value->id}}">
                                    <input class="btn btn-xs btn-primary" type="submit" name="status" value="Accepted">
                                </form>
                                <form method="post" action="{{route('admin.fund-request.store')}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$value->id}}">
                                    <input class="btn btn-xs btn-dark" type="submit" name="status" value="Reject">
                                </form>
                                @else
                                <input type="button" class="btn btn-xs @if($value->deposit_status == 'Reject')btn-danger @else btn-info @endif" name="" value="{{($value->deposit_status == 'Reject')?'Rejected':'Approved'}}">
                                @endif
                                <form method="post" action="{{route('admin.fund-request.destroy',$value->id)}}" onsubmit="return confirm('Are you sure');">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-xs btn-danger" type="submit" name="astatus" value="Delete">
                                </form>
                            </div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-danger">No data found</td>
                        </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
        {{$data->links()}}
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection

