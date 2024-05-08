@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-xl-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-white">Edit Distributor</h4>
                </div>
                <form action="{{ route('distributor.update',$distributor->id) }}" method="POST">@csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingnameInput" placeholder="Enter Name" name="name" value="{{ $distributor->name }}">
                                    <label for="floatingnameInput">Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingnameInput" placeholder="Enter Phone Number" name="phone_number" value="{{ $distributor->phone_number }}">
                                    <label for="floatingnameInput">Phone Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingnameInput" placeholder="Enter Nationality" name="business_name" value="{{ $distributor->business_name }}">
                                    <label for="floatingnameInput">Business Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="floatingnameInput" placeholder="Enter Address" name="address">{{ $distributor->address }}</textarea>
                                    <label for="floatingnameInput">Address</label>
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
        <script src="https://unpkg.com/imask"></script>
        <script>
            $(document).ready(function() {
                var element = document.getElementById('phone_number');
                var maskOptions = {
                    mask: Number,  // enable number mask
                    signed: false,  // disallow negative
                    min: 000000000,
                    max: 999999999
                };
                IMask(element, maskOptions);
            });
        </script>
    @endpush
@endsection
