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
                            Challange Name
                        </th>
                        <th>
                            Winning Amount
                        </th>
                        <th>
                            Challenge Type
                        </th>
                        <th>
                            Status
                        </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($result as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->challenge_name}}</td>
                            <td>{{$value->winning_amount}}</td>
                            <td>{{$value->challange_type}}</td>
                            <td>{{ucfirst(str_replace("_"," ",$value->status))??'-'}}</td>
                            <td>
                            	<a class="btn btn-xs btn-primary" href="{{ route('admin.show-result', $value->id) }}">VIEW</a>
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
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection

