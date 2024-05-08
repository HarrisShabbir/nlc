@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-xl-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h4 class="text-white">Add Vendor Pool</h4>
            </div>
            <form action="{{ route('vendorpool.store') }}" method="POST"> @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                                <label for="name">Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-control mb-3">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
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
        </div>
    </div>
</div>
@endsection
