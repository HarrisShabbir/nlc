@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-xl-8 offset-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-white">Edit Shift</h4>
                </div>
                <form action="{{ route('shift.update',$shift->id) }}" method="POST">@csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" value="{{ $shift->title }}" required>
                                    <label for="title">Title</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-control mb-3">
                                    <label for="time_from">Time From</label>
                                    <input type="time" class="form-control" id="time_from" placeholder="Enter Time From" name="time_from" value="{{ $shift->time_from }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-control mb-3">
                                    <label for="time_to">Time To</label>
                                    <input type="time" class="form-control" id="time_to" placeholder="Enter Time To" name="time_to" value="{{ $shift->time_to }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-control mb-3">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="Active" @if($shift->status == "Active") {{ "selected" }} @endif>Active</option>
                                        <option value="Inactive" @if($shift->status == "Inactive") {{ "selected" }} @endif>Inactive</option>
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
