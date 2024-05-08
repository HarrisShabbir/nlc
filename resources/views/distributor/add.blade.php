@extends('layouts.main')
@section('content')

<div class="row">
    <div class="col-xl-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h4 class="text-white">Add Distributor</h4>
            </div>
            <form action="{{ route('distributor.store') }}" method="POST">@csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required>
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
                                <input type="text" class="form-control" id="business_name" placeholder="Enter Business Name" name="business_name">
                                <label for="business_name">Business Name</label>
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
