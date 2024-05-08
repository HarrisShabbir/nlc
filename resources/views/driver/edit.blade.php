@extends('layouts.main')

@section('content')
    @push('style')
        <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/libs/@chenfengyuan/datepicker/datepicker.min.css') }}">
    @endpush

    <div class="row">
        <div class="col-xl-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-white">Edit Driver</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('driver.update',$driver->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <select class="form-control select2" name="vehicle_id">
                                        <option>Select a vehicle</option>
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" @if($vehicle->id == $driver->vehicle_id) {{ "selected" }} @endif>{{ $vehicle->maker_name." (".$vehicle->model_number.")" }}</option>
                                        @endforeach
                                    </select>
                                    {{--                                <label for="floatingnameInput">Vehicle</label>--}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingnameInput" placeholder="Enter Name" name="name" value="{{ $driver->name }}">
                                    <label for="floatingnameInput">Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingnameInput" placeholder="Enter Phone Number" name="phone_number" value="{{ $driver->phone_number }}">
                                    <label for="floatingnameInput">Phone Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingnameInput" placeholder="Enter CNIC" name="cnic" value="{{ $driver->cnic }}">
                                    <label for="floatingnameInput">CNIC</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingnameInput" placeholder="Enter License Number" name="license_number" value="{{ $driver->license_number }}">
                                    <label for="floatingnameInput">License Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="floatingnameInput" placeholder="Enter Date Of Birth" name="date_of_birth" value="{{ $driver->date_of_birth }}">
                                    <label for="floatingnameInput">Date Of Birth</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingnameInput" placeholder="Enter Nationality" name="nationality" value="{{ $driver->nationality }}">
                                    <label for="floatingnameInput">Nationality</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="floatingnameInput" placeholder="Enter Address" name="address" rows="15">{{ $driver->address }}</textarea>
                                    <label for="floatingnameInput">Address</label>
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
        <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
        <script src="{{ asset('assets/libs/@chenfengyuan/datepicker/datepicker.min.js') }}"></script>

        <!-- form advanced init -->
        <script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
    @endpush
@endsection
