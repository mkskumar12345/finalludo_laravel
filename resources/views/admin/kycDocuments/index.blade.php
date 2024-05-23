@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ isset($title) ? $title : '' }}
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
                                Aadhar No
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                {{ __('global.status') }}
                            </th>
                            <th>
                                Front Image
                            </th>
                            <th>
                                Back Image
                            </th>
                            <th>
                                {{ __('global.action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody> @php $i = ($kycDocuments->perPage() * ($kycDocuments->currentPage() - 1)) + 1; @endphp
                        @forelse($kycDocuments as $page)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $page->name }}</td>
                                <td>{{ $page->aadhar_no }}</td>
                                <td>{{ $page->email }}</td>

                                <td>{{ $page->status }}</td>
                                <td>
                                    <a href="{{ '/public/images/kyc/' . $page->front_image }}" target="_blank">
                                        <img src="{{ '/public/images/kyc/' . $page->front_image }}" style="width: 50px"
                                            alt="Front Image">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ 'public/images/kyc/' . $page->back_image }}" target="_blank">
                                        <img src="{{ '/public/images/kyc/' . $page->back_image }}" style="width: 50px"
                                            alt="Back Image">
                                    </a>
                                </td>

                                <td>
                                    @if ($page->status == 'Pending')
                                        <form
                                            action="{{ route('admin.updateStatus', ['id' => $page->id, 'action' => 'Approved']) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit">Approve</button>
                                        </form>
                                        <form
                                            action="{{ route('admin.updateStatus', ['id' => $page->id, 'action' => 'Rejected']) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit">Reject</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                    <tbody>
                    </tbody>
                </table>
                {{ $kycDocuments->links() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
