@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin:0 5px;" class="row">
        <div class="col-md-12 d-flex justify-content-end" style="height:40px;">
            <div>
            <a class="btn btn-success btn-xs" href="{{ route("admin.pages.create") }}">
                {{ __('global.add') }} {{ __('global.page') }}
            </a>
            </div>
            <div style="margin-left: 2px;">
         
        </div>
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
            <table class=" table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>
                            {{ __('cruds.user.fields.id') }}
                        </th>
                        <th>
                            {{ __('cruds.user.fields.name') }}
                        </th>
                        
                        <th>
                            {{ __('global.status') }}
                        </th>
                        <th>
                            {{ __('global.action') }}
                        </th>
                    </tr>
                </thead>
                <tbody> @php $i = ($pages->perPage() * ($pages->currentPage() - 1)) + 1; @endphp
                    @forelse($pages as $page)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$page->name}}</td>
                        
                        <td>{{($page->status == 1)?'Active':'In active'}}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{route('show-page', $page->slug)}}">VIEW</a>
                            <a class="btn btn-xs btn-info" href="{{route('admin.pages.edit', $page->id)}}">EDIT</a>
                            <form action="{{route('admin.pages.destroy', $page->id)}}" method="POST" onsubmit="return confirm('Are you sure');" style="display: inline-block;">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-xs btn-danger" value="DELETE">
                            </form>
                        </td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
                <tbody>
                </tbody>
            </table>
            {{$pages->links()}}
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
@endsection
