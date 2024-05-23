@extends('layouts.admin')
@section('content')
<div style="margin:0 5px;" class="row d-flex justify-content-end">
    <div class="form col-md-6 ">
        <form action="" method="GET" id="form-status" class="">
            <div class="row justify-content-end">
                <div class="select w-25">
                    <select class="form-control " name="user">
                        <option >User Filter</option>
                        @foreach($users as $item)
                         <option value="{{$item->id}}">{{$item->name ?? $item->phone}}</option>
                         @endforeach
                      </select>
                </div>
            </div>
        </form>
    </div>
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
            <table class=" table table-striped table-hover">
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
                            UPI ID
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            MyPay Status
                        </th> 
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $key => $value)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td> <a href="{{url('dashboard/users/'.$value->user_id,)}}"> {{$value->user_name}} </a></td>
                            <td>{{$value->amount}}</td>
                            <td>{{$value->withdrawal_upi_id ?? ''}}</td>
                            <td>{{date('d F Y h:i A',strtotime($value->created_at))}}</td>

                            <!-- <td>{{\Carbon\Carbon::parse($value->created_at)->format('d M, Y')}} </td> -->
                            <td><input type="button" class="btn btn-xs @if($value->addition_status == 'reject')btn-danger @elseif($value->addition_status == 'pending') btn-info @elseif($value->addition_status == 'cancel') btn-danger  @else btn-primary @endif" name="" value="{{($value->addition_status == 'reject')?'Rejected':(($value->addition_status == 'pending')?'Pending':($value->addition_status == 'cancel' ? 'Canceled':'Approved'))}}"></td>
                            <td> {{$value->payStatus}} 
                                <div class="d-flex">
                                @if($value->addition_status == 'pending')
                                <!--<form method="post" action="{{route('admin.wihdrawal-request.store')}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$value->id}}">
                                    <input class="btn btn-xs btn-primary" type="submit" name="astatus" value="approve">
                                </form>-->
                                <!--<form method="post" action="{{route('admin.wihdrawal-request.store')}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$value->id}}">
                                    <input class="btn btn-xs btn-danger" type="submit" name="astatus" value="reject">
                                </form>-->
                                @else
                                <!-- <input type="button" class="btn btn-xs @if($value->addition_status == 'reject')btn-danger @else btn-info @endif" name="" value="{{($value->addition_status == 'reject')?'Rejected':'Approved'}}"> -->
                                 
                                @endif
                                <!--<form method="post" action="{{route('admin.wihdrawal-request.destroy',$value->id)}}" onsubmit="return confirm('Are you sure');">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-xs btn-danger" type="submit" name="astatus" value="Delete">
                                </form>-->
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
            {{$data->withQueryString()->links()}}

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
@endsection