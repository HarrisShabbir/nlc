@extends('layouts.main')
@section('content')
@push('style')
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

<div class="row">
    <div class="col-xl-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h4 class="text-white">Add Driver</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('driver.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-control mb-3">
                                <select class="form-control select2" name="vehicle_id">
                                    <option value="">Select a vehicle</option>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->maker_name." (".$vehicle->model_number.")" }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" >
                                <label for="name">Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="phone_number" placeholder="Enter Phone Number" name="phone_number" required>
                                <label for="phone_number">Phone Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="cnic" placeholder="Enter CNIC" name="cnic" required>
                                <label for="cnic">CNIC</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="license_number" placeholder="Enter License Number" name="license_number" required>
                                <label for="license_number">License Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="date_of_birth" placeholder="Enter Date Of Birth" name="date_of_birth">
                                <label for="date_of_birth">Date Of Birth</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nationality" placeholder="Enter Nationality" name="nationality">
                                <label for="nationality">Nationality</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="address" placeholder="Enter Address" name="address"></textarea>
                                <label for="address">Address</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>

@push('scripts')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
    <script src="https://unpkg.com/imask"></script>
    <script>
        $(document).ready(function() {
            var element = document.getElementById('phone_number');
            var maskOptions = {
                mask: Number,  // enable number mask
                signed: false,  // disallow negative
                min: 0000000000,
                max: 9999999999
            };
            IMask(element, maskOptions);

            var element1 = document.getElementById('cnic');
            var maskOptions1 = {
                mask: Number,  // enable number mask
                signed: false,  // disallow negative
                min: 0000000000000,
                max: 9999999999999
            };
            IMask(element1, maskOptions1);

            var element2 = document.getElementById('license_number');
            var maskOptions2 = {
                mask: Number,  // enable number mask
                signed: false,
            };
            IMask(element2, maskOptions2);
        });
    </script>
@endpush
@endsection
