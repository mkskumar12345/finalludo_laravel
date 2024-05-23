@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin:0 5px;" class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <a class="btn btn-success btn-xs" href="{{ route('admin.challange-type.create') }}">
                {{ __('global.add') }} challange type
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
                       <th>Description</th>
                        <th>
                            {{ __('global.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = ($challangesType->perPage() * ($challangesType->currentPage() - 1)) + 1; @endphp
                    @forelse($challangesType as $c_type)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$c_type->name}}</td>
                        <td>{{$c_type->description??'-'}}</td>
                        <td>
                    <a class="btn btn-xs btn-info" href="{{route('admin.challange-type.edit', $c_type->id)}}">EDIT</a>
                    <form action="{{route('admin.challange-type.destroy', $c_type->id)}}" method="POST" onsubmit="return confirm('Are you sure');" style="display: inline-block;">
                    	@csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" class="btn btn-xs btn-danger" value="DELETE">
                    </form></td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-danger text-center" colspan="4">No data</td>
                    </tr>
                    @endforelse
                </tbody>
                <tbody>
                </tbody>
                {{$challangesType->links()}}
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection
