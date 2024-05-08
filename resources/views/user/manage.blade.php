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
                        Users
                        @can('user_add')
                        <a href="{{ route('user.create') }}" class="btn btn-primary" style="float:right"><i class="bx bx-plus"></i> Add User </a>
                        @endcan
                    </h4>
                </div>
                <div class="card-body">

                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>CNIC</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->cnic }}</td>
                                <td>
                                    @can('user_has_permission')
                                        <a href="{{ route('user.permissions',$user->id) }}" title="Permissions" class="btn btn-info"><i class="bx bx-shuffle"></i></a>
                                    @endcan
                                    @can('user_edit')
                                    <a href="{{ route('user.edit',$user->id) }}" class="btn btn-success"><i class="bx bx-edit"></i></a>
                                    @endcan
                                    @can('user_delete')
                                    <a href="{{ route('user.destroy',$user->id) }}" class="btn btn-danger"><i class="bx bx-trash"></i></a>
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