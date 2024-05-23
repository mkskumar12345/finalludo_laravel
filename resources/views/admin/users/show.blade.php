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
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Status
                        </th>
                        <td>
                            {{ ucfirst($user->status) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Phone No.
                        </th>
                        <td>
                            {{ $user->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Wallet + deposit balance
                        </th>
                        <td>
                            {{ number_format($user->wallet,2) }} + {{ number_format($user->deposit_amount,2) }} = {{ number_format(($user->deposit_amount + $user->wallet),2)}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Refer Amount
                        </th>
                        <td>
                            {{ number_format($ReferUsersTotal,2) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Is Able To Play
                        </th>
                        <td>
                            {{ $user->is_play ==1 ?'Yes':'No' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Profile Image
                        </th>
                        <td>@if(isset($user->profile_image))
                            <img src="{{ url($user->profile_image) }}" width="75" height="75">
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        
          <div class="row mt-3">
    <div class="col-lg-12 col-md-12">
    <div class="card">
    <div class="card-header card-header-tabs card-header-success">
    <div class="nav-tabs-navigation">
    <div class="nav-tabs-wrapper">
    <ul class="nav nav-tabs d-flex justify-content-around" data-tabs="tabs">
    <li class="nav-item">
    <a class="nav-link active" href="#profile" data-toggle="tab">
    <!-- <i class="material-icons">bug_report</i>  -->
    Challange
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#messages" data-toggle="tab">
    <!-- <i class="material-icons">code</i> -->
     Fund Added
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#settings" data-toggle="tab">
    <!-- <i class="material-icons">cloud</i> -->
     Withdrawal Request
    </a>
    </li>
    </ul>
    </div>
    </div>
    </div>
    <div class="card-body">
    <div class="tab-content">
    <div class="tab-pane active" id="profile">
            <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                        SN
                        </th>
                        <th>
                            Challange Name
                        </th>
                        <th>
                            Creator
                        </th>
                        <th>
                            Acceptor
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Winner
                        </th>
                   
                    </tr>
                </thead>
                <tbody>
                    @php $i = ($query->perPage() * ($query->currentPage() - 1)) + 1; @endphp
                    @forelse($query as $user)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$user->challenge_name}}</td>
                        <td>{{$user->c_name}}</td>
                        <td>{{$user->a_name??'-'}}</td>
                        <td>{{$user->status??'-'}}</td>
                        <td>{{$user->amount??'-'}}</td>
                        <td>{{($user->who_win == $user->challenge_created_by)?$user->c_name:''}}
                            {{($user->who_win == $user->challenge_accepted_by)?$user->a_name:''}}
                        </td>
                        
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="test-danger text-center">No Data Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$query->links()}}
        </div>
    </div>
    <div class="tab-pane" id="messages">
    <table class="table table-striped table-hover">
    <thead class="text-dark">
    <tr><th>SN</th>
    <th>Amount</th>
    <th>Status</th>
    <th>Date</th>
    <th>isAdmin</th>
    </tr></thead>
    <tbody>
       @php $i = ($funds->perPage() * ($funds->currentPage() - 1)) + 1; @endphp
                    @forelse($funds as $value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$value->amount}}</td>
                        <td>{{$value->addition_status}}</td>
                        <td>{{date('d F Y h:i A',strtotime($value->created_at))}}</td>
                        <td>{{$value->isAdmin == 0?'No':'Yes'}}</td>
                        
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="test-danger text-center">No Data Found</td>
                    </tr>
                    @endforelse
    </tbody>
    </table>
    {{$funds->links()}}
    </div>
    <div class="tab-pane" id="settings">
     <table class="table">
    <thead class="text-dark">
    <tr><th>SN</th>
    <th>Amount</th>
    <th>Status</th>
    <th>Date</th>
    <th>isAdmin</th>
    </tr></thead>
    <tbody>
       @php $i = ($withdrawals->perPage() * ($withdrawals->currentPage() - 1)) + 1; @endphp
                    @forelse($withdrawals as $value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$value->amount}}</td>
                        <td>{{$value->addition_status}}</td>
                        <td>{{date('d F Y h:i A',strtotime($value->created_at))}}</td> 
                        <td>{{$value->isAdmin == 0?'No':'Yes'}}</td>
                        
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="test-danger text-center">No Data Found</td>
                    </tr>
                    @endforelse
    </tbody>
    </table>
    {{$withdrawals->links()}}
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>


    <div class="row mt-3">
        <div class="col-lg-12 col-md-12">
        <div class="card">
        <div class="card-header card-header-tabs card-header-info">
        <div class="nav-tabs-navigation">
        <div class="nav-tabs-wrapper">
        <ul class="nav nav-tabs d-flex justify-content-around" data-tabs="tabs">
        <li class="nav-item">
        <a class="nav-link active" href="#profile2" data-toggle="tab">
        <!-- <i class="material-icons">bug_report</i>  -->
        User Notifications
        </a>
      
        </ul>
        </div>
        </div>
        </div>
        <div class="card-body">
        <div class="tab-content">
        <div class="tab-pane active" id="profile2">
                <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                Title
                            </th>
                            <th>
                                Order ID 
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Closing Balance
                            </th>
                            <th>
                                Time
                            </th>
                           
                       
                        </tr>
                    </thead>
                    <tbody>
                       
                        @forelse($Transaction as $user)
                        <tr style=" @if($user->type=='credit') color:green @endif @if($user->type=='debit') color:red @endif ">
                            <td>{{$user->title}}</td>
                            <td>{{$user->transactions_id}}</td>
                            <td>{{number_format($user->amount,2)}}</td>
                            <td>{{$user->closing_balance??'-'}}</td>
                            <td>{{date('d F Y h:i A',strtotime($user->created_at))}}</td>
                            
                            
                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="test-danger text-center">No Data Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{$Transaction->links()}}
            </div>
        </div>
        
        </div>
        </div>
        </div>
        </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12 col-md-12">
            <div class="card">
            <div class="card-header card-header-tabs card-header-success">
            <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
            <ul class="nav nav-tabs d-flex justify-content-around" data-tabs="tabs">
            <li class="nav-item">
            <a class="nav-link active" href="#profile55" data-toggle="tab">
            <!-- <i class="material-icons">bug_report</i>  -->
            User Refers
            </a>
          
            </ul>
            </div>
            </div>
            </div>
            <div class="card-body">
            <div class="tab-content">
            <div class="tab-pane active" id="profile2">
                    <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>
                                    User
                                </th>
                                <th>
                                    Amount
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @forelse($ReferUsers as $user)
                            <tr style=" @if($user->type=='credit') color:green @endif @if($user->type=='debit') color:red @endif ">
                                <td>{{$user->user->name ?? ''}}</td>
                                <td>{{number_format($user->amount,2)}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="test-danger text-center">No Data Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{$ReferUsers->links()}}
                </div>
            </div>
            
            </div>
            </div>
            </div>
            </div>
            </div>
        
</div>
@endsection
