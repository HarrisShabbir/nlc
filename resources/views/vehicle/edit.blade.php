@extends('layouts.main')

@section('content')
    @push('style')
        <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    @if (Session::has('message'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('message')}}
        </div>
    @endif
    <div class="row">
        <div class="col-xl-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-white">Edit Vehicle</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('vehicle.update',$vehicle->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-control mb-3">
                                    <lable for="driver_id">Driver</lable>
                                    <select class="form-control select2" id="driver_id" name="driver_id" required>
                                        <option>Select a driver</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}" @if($driver->id == $vehicle->driver_id) {{ "selected" }} @endif>{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-control mb-3">
                                    <lable for="vendor_pool_id">Vendor Pool</lable>
                                    <select class="form-control select2" id="vendor_pool_id" name="vendor_pool_id" required>
                                        <option>Select a vendor pool</option>
                                        @foreach($vendorpools as $vendorpool)
                                            <option value="{{ $vendorpool->id }}" @if($vendorpool->id == $vehicle->vendor_pool_id) {{ "selected" }} @endif>{{ $vendorpool->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="registration_number" placeholder="Enter Registration Number" name="registration_number" value="{{ $vehicle->registration_number }}">
                                    <label for="registration_number">Registration Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="registration_year" minlength="4" maxlength="4" placeholder="Enter Registration Year" name="registration_year" value="{{ $vehicle->registration_year }}">
                                    <label for="registration_year">Registration Year</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="maker_name" placeholder="Enter Maker Name" name="maker_name" value="{{ $vehicle->maker_name }}">
                                    <label for="maker_name">Maker Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="model_number" placeholder="Enter Model Number" name="model_number" value="{{ $vehicle->model_number }}">
                                    <label for="model_number">Model Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
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
                var element = document.getElementById('registration_number');
                var maskOptions = {
                    mask: Number,  // enable number mask
                    signed: false,  // disallow negative
                };
                IMask(element, maskOptions);

                var element1 = document.getElementById('registration_year');
                var maskOptions1 = {
                    mask: Date,  // enable number mask
                    pattern: 'YYYY',
                    blocks: {
                        Y: {
                            mask: IMask.MaskedRange,
                            from: 1900,
                            to: 9999,
                        }
                    }
                };
                IMask(element1, maskOptions1);
            });
        </script>
    @endpush
@endsection
