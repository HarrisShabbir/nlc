@extends('layouts.main')

@section('content')

@push('style')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="text-white">
                    Drivers
                    @can('driver_add')
                    <a href="{{ route('driver.create') }}" class="btn btn-primary" style="float:right"><i class="bx bx-plus"></i> Add Driver </a>
                    @endcan
                </h4>
            </div>
            <div class="card-body">

                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Date of Birth</th>
                            <th>CNIC</th>
                            <th>Nationality</th>
                            <th>Address</th>
                            <th>License Number</th>
                            <th>Vehicle</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($drivers as $driver)
                            <tr>
                                <td>{{ $driver->name }}</td>
                                <td>{{ $driver->phone_number }}</td>
                                <td>{{ $driver->date_of_birth }}</td>
                                <td>{{ $driver->cnic }}</td>
                                <td>{{ $driver->nationality }}</td>
                                <td>{{ $driver->address }}</td>
                                <td>{{ $driver->license_number }}</td>
                                <td>{{ $driver->vehicle ? ($driver->vehicle->maker_name." (".$driver->vehicle->model_number." )") : "Vehicle not selected" }}</td>
                                <td>
                                    @can('driver_edit')
                                    <a href="{{ route('driver.edit',$driver->id) }}" class="btn btn-success"><i class="bx bx-edit"></i></a>
                                    @endcan
                                    @can('driver_delete')
                                    <a href="{{ route('driver.destroy',$driver->id) }}" class="btn btn-danger"><i class="bx bx-trash"></i></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@push('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $("#datatable").DataTable(),
            $("#datatable-buttons").DataTable({
                lengthChange:!1,
                buttons:["copy","excel","pdf","colvis"]
            }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),
            $(".dataTables_length select").addClass("form-select form-select-sm")});
    </script>
@endpush
@endsection
