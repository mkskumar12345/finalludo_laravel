@extends('layouts.admin')
@section('content')

 <style>
    /* div#grdPrUpPrj_info {
    display: none !important;
}
div#grdPrUpPrj_paginate {
    display: none !important;
}
ul.pagination {
    margin-top: 10px !important;
}

div#grdPrUpPrj_length {
    display: none !important;
}
div#grdPrUpPrj_filter {
    display: none !important;
} */
 </style>
@can('user_create')
    <div style="margin:0 5px;" class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <a class="btn btn-success btn-xs" href="{{ route("admin.users.create") }}">
                {{ __('global.add') }} {{ __('cruds.user.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ isset($title)?$title:'' }}
        </h4>
    </div>

    <div class="card-body">
    <form action="" method="GET">
            <div class="d-flex">
                <input type="text" name="search" class="form-control" value="{{ app('request')->input('search') }}" style="margin-right: 2px;" placeholder="Search phone no or email">
         
                <button class="btn btn-xs  btn-primary" type="submit">Search</button>
                <form action="" method="GET">
                    <select name="wallet" id="amount_filter" class="form-control" style="width: 23%;margin-left: 19px;margin-top: 12px;">
                        <option value="">Select filter</option>
                        <option value="3" {{ app('request')->input('wallet')  =='3' ? 'selected' : '' }}>New</option>
                        <option value="1" {{ app('request')->input('wallet')  =='1' ? 'selected' : '' }}>Wallet Balance</option>
                        <option value="2" {{ app('request')->input('wallet') =='2' ? 'selected' : '' }}>Deposit Balance</option>
                    </select>
                </form>
            </div>
            </form>
        
            <!-- <a class="btn btn-xs btn-info" href="{{url('dashboard/users?q=filter')}}">Filter</a> -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            {{ __('cruds.user.fields.id') }}
                        </th>
                        <th>
                            {{ __('cruds.user.fields.name') }}
                        </th>
                    
                        <th>
                            {{ __('cruds.user.fields.phone') }}
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            {{ __('global.wallet') }}
                        </th>
                        <th>
                            Deposit Amount
                        </th>
                       
                        <th>
                            {{ __('global.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users  as $key => $user)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->phone??'-'}}</td>
                        <td>{{$user->email??'-'}}</td>
                        <td> {{ number_format(($user->wallet),2)}}</td>
                        <td> {{ number_format(($user->deposit_amount),2)}}</td>
                        <td><a class="btn btn-xs btn-primary" href="{{route('admin.users.show', $user->id)}}">view</a>
                    <a class="btn btn-xs btn-info" href="{{route('admin.users.edit', $user->id)}}">Edit</a>
                    <!--<form action="{{route('admin.users.destroy', $user->id)}}" method="POST" onsubmit="return confirm('.trans('global.areYouSure').');" style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                    </form>-->
                    <button class="btn btn-xs btn-success amount-action" type="button" onclick="datat(<?php echo $user->id ?>)" data-toggle="modal" data-target="#exampleModal">CR/DR</button>
                </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="test-danger text-center">No data found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{$users->withQueryString()->links()}}
        </div>
    </div>
</div>

                <!-- model for popup -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Withdrawal and Add money</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="{{route('admin.money-man')}}" method="POST">
                      <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" value="" id="user_id">
                        <div class="">
                        <div class="">
                        <select class="form-select form-control" required aria-label="Default select example" name="action">
                          <option selected>Select Type</option>
                          <option value="cr">Add Money</option>
                          <option value="dr">Remove Money</option>
                        </select>
                        </div>
                        <div>
                        <input type="text" step="0.01" name="amount" min="1" class="form-control mt-3" placeholder="Enter Amount" required>
                        <input type="text"  name="title" class="form-control mt-3" placeholder="Title" required>
                        </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>

@endsection
@section('scripts')
<script type="text/javascript">
 function datat(userId){
        $('#user_id').val(userId);
    }
    $('#amount_filter').change(function() {
     $(this).closest('form').submit();
    });
</script>
@parent

@endsection
