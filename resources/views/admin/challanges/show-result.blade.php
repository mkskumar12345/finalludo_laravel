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
                            Challange Name
                        </th>
                        <td>
                            {{ $result->challenge_name ??'-'}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Challange Type
                        </th>
                        <td>
                            {{ $result->challange_type ??'-'}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Challange Creator Name
                        </th>
                        <td>
                            {{ $result->c_name ??'-'}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Challange Acceptor Name
                        </th>
                        <td>
                            {{ $result->a_name ??'-'}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Creator Action
                        </th>
                        <td>
                            {{ $result->creator_action??'-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Acceptor Action
                        </th>
                        <td>
                            {{ $result->acceptor_action ??'-'}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Creator proof
                        </th>
                        <td>
                            @if(isset($result->creator_image))
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Acceptor proof
                        </th>
                        <td>
                            @if(isset($result->acceptor_image))
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Status
                        </th>
                        <td>
                            {{$result->status??'-'}}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            Winning Amount
                        </th>
                        <td>
                            {{ $result->winning_amount ??'-'}}
                        </td>
                    </tr>
                     @if($result->status == 'in-review')
                    <tr>
                        <th>
                            Mark Winner
                        </th>
                        <td>
                            <form id="winner" action="{{route('admin.mark-winner')}}" method="POST">
                            	@csrf
                            	<input type="hidden" name="challange_id" value="{{$result->challange_id}}">
                            	<select name="who_win" class="form-control form-control-sm">
                            		<option value="">Select winner</option>
                            		<option value="{{$result->challenge_accepted_by}}">{{$result->a_name??'-'}}</option>
                            		<option value="{{$result->challenge_created_by}}">{{$result->c_name??'-'}}</option>
                            	</select>
                            </form>

                        </td>
                    </tr>
                    @endif
                    @if($result->status == 'complete')
                    <tr>
                        <th>
                            Winner
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
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection
