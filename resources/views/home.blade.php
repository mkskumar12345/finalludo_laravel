@extends('layouts.admin')
@section('content')
<style type="text/css">
    .card-icon{
        padding: 0;
    }
    thead {
        font-weight:900;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fa-fw fas fa-user"></i>
                        </div>
                        <p class="card-category">Total Users</p>
                        <h3 class="card-title">
                            <!-- <small>GB</small> -->
                            {{$users->total_users}}
                        </h3>
                    </div>
                 
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-trophy"></i>
                    </div>
                    <p class="card-category">Open Challange</p>
                    <h3 class="card-title">{{$open_challange}}</h3>
                </div>
       
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-user-times"></i>
                        </div>
                        <p class="card-category">Block Users</p>
                        <h3 class="card-title">{{$busers}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                        </div>
                        <p class="card-category">Today Add Fund</p>
                        <h3 class="card-title">{{number_format($todayAddFund,2)}}</h3>
                        <h5 class="card-title">Admin: <b>{{number_format($todayAddFundAdmin,2)}}</b></h5>
                        <h5 class="card-title">PG: <b>{{number_format($todayAddFundPG,2)}}</b></h5>
                    </div>
    
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48"><path d="M19.3788 15.1057C20.9258 11.442 19.5373 7.11425 16.0042 5.07444C13.4511 3.6004 10.4232 3.69359 8.03452 5.05554L7.04216 3.31873C10.028 1.61633 13.8128 1.49984 17.0042 3.34239C21.4949 5.93507 23.2139 11.4848 21.1217 16.1119L22.4635 16.8866L18.2984 19.1007L18.1334 14.3866L19.3788 15.1057ZM4.62961 8.89962C3.08263 12.5633 4.47116 16.891 8.00421 18.9308C10.5573 20.4049 13.5851 20.3117 15.9737 18.9499L16.9661 20.6866C13.9803 22.389 10.1956 22.5054 7.00421 20.6629C2.51357 18.0702 0.794565 12.5205 2.88672 7.89336L1.54492 7.11867L5.70999 4.90457L5.87505 9.61867L4.62961 8.89962ZM8.50421 14.0026H14.0042C14.2804 14.0026 14.5042 13.7788 14.5042 13.5026C14.5042 13.2265 14.2804 13.0026 14.0042 13.0026H10.0042C8.6235 13.0026 7.50421 11.8834 7.50421 10.5026C7.50421 9.12193 8.6235 8.00265 10.0042 8.00265H11.0042V7.00265H13.0042V8.00265H15.5042V10.0026H10.0042C9.72807 10.0026 9.50421 10.2265 9.50421 10.5026C9.50421 10.7788 9.72807 11.0026 10.0042 11.0026H14.0042C15.3849 11.0026 16.5042 12.1219 16.5042 13.5026C16.5042 14.8834 15.3849 16.0026 14.0042 16.0026H13.0042V17.0026H11.0042V16.0026H8.50421V14.0026Z" fill="rgba(250,244,244,1)"></path></svg>                          </div>
                        <p class="card-category">Today Wdrl</p>
                        <h3 class="card-title">{{number_format($todayWithdrawal,2)}}</h3>
                    </div>
    
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                        </div>
                        <p class="card-category">Total Add Fund</p>
                        <h3 class="card-title">{{number_format($totalAddFund,2)}}</h3>
                        <h5 class="card-title">Admin: <b>{{number_format($totalAddFundAdmin,2)}}</b></h5>
                        <h5 class="card-title">PG: <b>{{number_format($totalAddFundPG,2)}}</b></h5>
                    </div>
    
                </div>
            </div>
           
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48"><path d="M20.0049 7V5H4.00488V19H20.0049V17H12.0049C11.4526 17 11.0049 16.5523 11.0049 16V8C11.0049 7.44772 11.4526 7 12.0049 7H20.0049ZM3.00488 3H21.0049C21.5572 3 22.0049 3.44772 22.0049 4V20C22.0049 20.5523 21.5572 21 21.0049 21H3.00488C2.4526 21 2.00488 20.5523 2.00488 20V4C2.00488 3.44772 2.4526 3 3.00488 3ZM13.0049 9V15H20.0049V9H13.0049ZM15.0049 11H18.0049V13H15.0049V11Z" fill="rgba(245,238,238,1)"></path></svg>
                        </div>
                        <p class="card-category">Today Income</p>
                        <h3 class="card-title">{{number_format($todayIncome,2)}}</h3>
                        <h5 class="card-title">Refer: {{number_format($todayRefer,2)}}</h5>
                    </div>
    
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                        </div>
                        <p class="card-category">Total Income</p>
                        <h3 class="card-title">{{number_format($incomes,2)}}</h3>
                        <h5 class="card-title">Refer: {{number_format($totalRefer,2)}}</h5>

                    </div>
    
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                        </div>
                        <p class="card-category">Today Tables</p>
                        <h3 class="card-title">{{$total_tabel}}</h3>
                    </div>
    
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48"><path d="M12.0049 22.0029C6.48204 22.0029 2.00488 17.5258 2.00488 12.0029C2.00488 6.48008 6.48204 2.00293 12.0049 2.00293C17.5277 2.00293 22.0049 6.48008 22.0049 12.0029C22.0049 17.5258 17.5277 22.0029 12.0049 22.0029ZM12.0049 20.0029C16.4232 20.0029 20.0049 16.4212 20.0049 12.0029C20.0049 7.58465 16.4232 4.00293 12.0049 4.00293C7.5866 4.00293 4.00488 7.58465 4.00488 12.0029C4.00488 16.4212 7.5866 20.0029 12.0049 20.0029ZM10.0549 11.0029H15.0049V13.0029H10.0549C10.2865 14.144 11.2954 15.0029 12.5049 15.0029C13.1201 15.0029 13.6833 14.7807 14.1188 14.4122L15.8198 15.5462C14.9973 16.4417 13.8166 17.0029 12.5049 17.0029C10.1886 17.0029 8.28107 15.2529 8.03235 13.0029H7.00488V11.0029H8.03235C8.28107 8.75295 10.1886 7.00293 12.5049 7.00293C13.8166 7.00293 14.9973 7.5642 15.8198 8.45969L14.1189 9.59369C13.6834 9.22515 13.1201 9.00293 12.5049 9.00293C11.2954 9.00293 10.2865 9.86181 10.0549 11.0029Z" fill="rgba(253,248,248,1)"></path></svg>
                        </div>
                        <p class="card-category">Deposit + Wallat</p>
                        <h3 class="card-title">{{number_format($userDeposit,2)}} + {{number_format($userWallat,2)}} = {{number_format(($userWallat + $userDeposit),2)}}</h3>
                    </div>
    
                </div>
            </div>
        </div>
            
    <div class="row">
    <div class="col-lg-6 col-md-12">
    <div class="card">
    <div class="card-header card-header-tabs card-header-primary">
    <div class="nav-tabs-navigation">
    <div class="nav-tabs-wrapper">
    <span class="nav-tabs-title">Challenges:</span>
    <ul class="nav nav-tabs" data-tabs="tabs">
    <li class="nav-item">
    <a class="nav-link active" href="#profile" data-toggle="tab">
    <!-- <i class="material-icons">bug_report</i>  -->
    Open
    <div class="ripple-container"></div>
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#messages" data-toggle="tab">
    <!-- <i class="material-icons">code</i> -->
     Running
    <div class="ripple-container"></div>
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#settings" data-toggle="tab">
    <!-- <i class="material-icons">cloud</i> -->
     Complete
    <div class="ripple-container"></div>
    </a>
    </li>
    </ul>
    </div>
    </div>
    </div>
    <div class="card-body">
    <div class="tab-content">
    <div class="tab-pane active" id="profile">
    <table class="table">
     <thead class="text-dark">
    <tr><th>SN</th>
    <th>Challange</th>
    <th>User</th>
    <th>Amount</th>
    <th>Date</th>
    </tr></thead>
    <tbody>
        @php $i =1; @endphp
        @forelse($opens as $value)
            <tr>
            <td>{{$i++}}</td>
            <td>{{$value->challenge_name??'-'}}</td>
            <td>{{$value->name}}</td>
            <td>{{$value->amount}}</td>
            <td>{{\Carbon\Carbon::parse($value->created_at)->format('d M Y')}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-danger"> No Data Found</td>
            </tr>
        @endforelse
    </tbody>
    </table>
    </div>
    <div class="tab-pane" id="messages">
    <table class="table">
    <thead class="text-dark">
    <tr><th>SN</th>
    <th>Challange</th>
    <th>Created By</th>
    <th>Amount</th>
    <th>Accepted By</th>
    </tr></thead>
    <tbody>
        @php $i =1; @endphp
        @forelse($running as $value)
            <tr>
            <td>{{$i++}}</td>
            <td>{{$value->challenge_name??'-'}}</td>
            <td>{{$value->c_name}}</td>
            <td>{{$value->amount}}</td>
            <td>{{$value->a_name}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-danger"> No Data Found</td>
            </tr>
        @endforelse
    </tbody>
    </table>
    </div>
    <div class="tab-pane" id="settings">
    <table class="table">
         <thead class="text-dark">
    <tr><th>SN</th>
    <th>Challange</th>
    <th>Created By</th>
    <th>Accepted By</th>
    <th>Amount</th>
    <th>Winner</th>
    </tr></thead>
    <tbody>
        @php $i =1; @endphp
        @forelse($Complete as $value)
            <tr>
            <td>{{$i++}}</td>
            <td>{{$value->challenge_name??'-'}}</td>
            <td>{{$value->c_name}}</td>
            <td>{{$value->a_name}}</td>
            <td>{{$value->amount}}</td>
            <td>{{$value->winner_name}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-danger"> No Data Found</td>
            </tr>
        @endforelse
    </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-6 col-md-12">
    <div class="card">
    <div class="card-header card-header-success">
    <span style="float:right; font-size:12px">Total Withdrawal : {{number_format($totalWithdrawal,2)}}</span>
    <h4 class="card-title">Withdrawal Request </h4>
    <p class="card-category">Recent user request for money</p>
    </div>
    <div class="card-body table-responsive">
    <table class="table table-hover">
    <thead class="text-dark">
    <tr><th>SN</th>
    <th>User Name</th>
    <th>Amount</th>
    <th>Status</th>
    <th>Date</th>
    </tr></thead>
    <tbody>
        @php $i =1; @endphp
        @forelse($with_request as $value)
            <tr>
            <td>{{$i++}}</td>
            <td> <a href="{{url('dashboard/users/'.$value->user_id)}}">  {{$value->user_name}} </a></td>
            <td>{{$value->amount}}</td>
            <td> <span class="btn btn-xs @if($value->addition_status == 'pending')btn-info @elseif($value->addition_status == 'approve') btn-success @else btn-danger @endif">{{ucfirst($value->addition_status)}}</span></td>
            <td>{{ \Carbon\Carbon::parse($value->created_at)->format('d M Y')}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-danger"> No Data Found</td>
            </tr>
        @endforelse
    </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection
@section('scripts')
@parent

@endsection