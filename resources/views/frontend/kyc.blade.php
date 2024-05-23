@extends('layouts.frontend')
@section('content')
    <div class=" col-12 mx-auto p-3 g-0">

        <div class="mb-3 shadow card">
            @if ($kycStatus && $kycStatus !== 'Rejected')
                <p style="padding: 10px;">Your KYC status is: {{ $kycStatus }}</p>
            @else
                <form action="{{ route('uploadKycDoc') }}" method="POST" id="update-profile" enctype="multipart/form-data">
                    @csrf

                    <div class="bg-light text-dark text-capitalize card-header" style="text-align: center;">Upload KYC
                        Documents</div>
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-start justify-content-center mb-3 mt-1">
                            <label class="form-label text-capitalize">Name</label>
                            <div class="align-self-stretch d-flex align-items-center">
                                <input type="text" name="name" class="form-control me-2" required>
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex flex-column align-items-start justify-content-center mb-3 mt-1">
                            <label class="form-label text-capitalize">Aadhar No</label>
                            <div class="align-self-stretch d-flex align-items-center">
                                <input type="number" name="aadhar_no" class="form-control me-2" required>
                            </div>
                            @error('aadhar_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex flex-column align-items-start justify-content-center mb-3 mt-1">
                            <label class="form-label text-capitalize">Email</label>
                            <div class="align-self-stretch d-flex align-items-center">
                                <input type="email" name="email" class="form-control me-2" required>
                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex flex-column align-items-start justify-content-center mb-3 mt-1">
                            <label class="form-label text-capitalize">Date of Birth</label>
                            <div class="align-self-stretch d-flex align-items-center">
                                <input type="date" name="dob" class="form-control me-2" required>
                            </div>
                            @error('dob')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex flex-column align-items-start justify-content-center mb-3 mt-1">
                            <label class="form-label text-capitalize">Front Image</label>
                            <div class="align-self-stretch d-flex align-items-center">
                                <input type='file' name="front_image" id="front_image" accept=".png, .jpg, .jpeg"
                                    required />
                            </div>
                            @error('front_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex flex-column align-items-start justify-content-center mb-3 mt-1">
                            <label class="form-label text-capitalize">Back Image</label>
                            <div class="align-self-stretch d-flex align-items-center">
                                <input type='file' name="back_image" id="back_image" accept=".png, .jpg, .jpeg"
                                    required />
                            </div>
                            @error('back_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success text-capitalize btn-sm align-self-stretch ml-2"
                            style="width: 73px;font-size: 15px;">Update</button>
                            <br>
                            <br>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
