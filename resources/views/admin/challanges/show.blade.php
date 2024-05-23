@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.show') }} {{ trans('cruds.user.title') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            <strong>{{ $challange->id }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Challange Name
                        </th>
                        <td>
                            <strong>{{ $challange->challenge_name??'-' }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Challange Created By
                        </th>
                        <td>
                            <strong>{{ $challange->createBy->name ??'-' }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Challange Accepted By
                        </th>
                        <td>
                            <strong>{{ $challange->acceptedBy->name??'-' }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Amount
                        </th>
                        <td>
                            <strong>{{$challange->amount??'-'}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Winner Amount
                        </th>
                        <td>
                            <strong>{{$challange->winning_amount??'-'}}</strong>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Status
                        </th>
                        <td>
                            <strong>{{ucfirst(str_replace('_',' ',$challange->status))}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Challange Type
                        </th>
                        <td>
                            <strong><h3 style="color: red;font-weight: 600;"><b>{{$challange->challangeType->name??'-'}}</b></h3></strong>
                        </td>
                    </tr>
                    @if(isset($result))
             
                    <tr>
                        <th>
                            Creator Action
                        </th>
                        <td>
                            <strong>{{ $result->creator_action??'-' }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Acceptor Action
                        </th>
                        <td>
                            <strong>{{ $result->acceptor_action ??'-'}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Acceptor Cancel
                        </th>
                        <td>
                            <strong>{{ $result->cencal_acceptor ? 'Yes' : '-'}}</strong> @if(!empty($result->acceptor_cancel_time)) ({{date('d M Y h:i:s A',strtotime($result->acceptor_cancel_time))}}) @endif  
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Creator cancel
                        </th>
                        <td>
                            <strong>{{ $result->cencal_creator ? 'Yes' : '-' }}</strong> @if(!empty($result->creator_cancel_time)) ({{date('d M Y h:i:s A',strtotime($result->creator_cancel_time))}}) @endif 
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Room code
                        </th>
                        <td>
                        <b><h3 style="color: #088908;font-weight: 600;">{{ $challange->room_code }}</h3></b>   @if(!empty($challange->room_code_time)) ({{date('d M Y h:i:s A',strtotime($challange->room_code_time))}}) @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Creator Proof ({{ $challange->createBy->name ??'-' }})
                        </th>
                        <td>
                            @if(isset($result->creator_image) && !empty($result->creator_image))
                            <img data-toggle="modal" data-target="#exampleModalLong" src="{{url('assets/challangeResult/'.$result->creator_image)}}" height="75" width="75">
                            @endif
                            @if(!empty($result->creator_time)) ({{date('d M Y h:i:s A',strtotime($result->creator_time))}}) @endif
                        </td>
                        <div class="modal fade" id="exampleModalLon33g" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                   <div class="screenshot_img">
                                   <img src="{{url('assets/challangeResult/'.$result->creator_image)}}" style="width:100%">
                                   </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: green;color: white;font-size: 11px;">Close</button>
                                </div>
                                </div>
                            </div>
                            </div>
                    </tr>
                    <tr>
                        <th>
                            Acceptor Proof ({{ $challange->acceptedBy->name??'-' }})
                        </th>
                        <td>
                            @if(isset($result->acceptor_image) && !empty($result->acceptor_image))
                            <img data-toggle="modal" data-target="#exampleModalLong2" src="{{url('assets/challangeResult/'.$result->acceptor_image)}}" height="75" width="75">
                            @if(!empty($result->acceptor_time)) ({{date('d M Y h:i:s A',strtotime($result->acceptor_time))}}) @endif
                            @endif
                        </td>
                        <div class="modal fade" id="exampleModalLong222" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                   <div class="screenshot_img">
                                   <img src="{{url('assets/challangeResult/'.$result->acceptor_image)}}" style="width:100%">
                                   </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: green;color: white;font-size: 11px;">Close</button>
                                </div>
                                </div>
                            </div>
                            </div>
                    </tr>
               
                    @if($result->status == 'in_review')
                    <tr>
                        <th>
                            {{ ($result->status == 'in_review')?'Make Winner':'Winner' }}
                        </th>
                        <td>
                            <form id="" action="{{route('admin.mark-winner')}}" onsubmit="return confirm('Are You Sure You');" method="POST">
                                @csrf
                                <input type="hidden" name="challange_id" value="{{$result->challange_id}}">
                                <div class="d-flex justify-content-around">
                                <div>
                                <select name="who_win" class="form-control form-control-sm" required>
                                    <option value="">Select Winner</option>
                                    <option value="{{$result->challenge_created_by}}"  {{($result->challenge_created_by == $result->who_win)?'selected':''}}>{{$result->c_name??'-'}}</option>
                                    <option value="{{$result->challenge_accepted_by}}" {{($result->challenge_accepted_by == $result->who_win)?'selected':''}}>{{$result->a_name??'-'}}</option>
                                </select>
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-xs btn-success" value="Submit">
                                </div>
                                </div>
                            </form>

                        </td>
                    </tr>
                    @endif
                    @if($result->status == 'complete')
                    <tr>
                        <th>
                            Current Winner
                        </th>
                        <td>
                            {{($result->challenge_created_by == $result->who_win)?$result->c_name:$result->a_name}}
                        </td>
                    </tr>
                    @endif
                     @if($result->status == 'cancel')
                    <tr>
                        <th>
                            Cancel By
                        </th>
                        <td>
                            {{($result->challenge_created_by == $result->who_cancel)?$result->c_name:$result->a_name}}
                        </td>
                    </tr>
                    @endif
                    @endif
                    <tr>
                        <th>
                            Cancel
                        </th>
                        <td>
                        @if($challange->status == 'in_review' || $challange->status == 'running' || $challange->status == 'challange_created')
                       <a onclick="return confirm('Are You Sure You');" href="{{url('dashboard/challange-cancel/'.$challange->id)}}" ><input  class="btn btn-xs btn-success" value="Cancel Challagne"></a>
                        @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection
