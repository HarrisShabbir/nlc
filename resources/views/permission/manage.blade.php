@extends('layouts.main')

@section('content')

@push('style')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@if (Session::has('message'))
    <div class="alert alert-danger" role="alert">
        {{Session::get('message')}}
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="text-white">
                    Permissions
                    @can('permission_add')
                        <button type="button" class="btn btn-primary waves-effect" data-bs-toggle="modal" data-bs-target="#addpermission" style="float:right">
                            <i class="bx bx-plus"></i> Add Permission
                        </button>
                    @endcan
                </h4>
            </div>
            <div class="card-body">
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    @can('permission_edit')
                                        <button type="button" onclick="editPermission({{ $permission->id }})" class="btn btn-success waves-effect" data-bs-toggle="modal" data-bs-target="#editrole"><i class="bx bx-edit"></i></button>
                                    @endcan
                                    @can('permission_delete')
                                    <a href="{{ route('permission.destroy',$permission->id) }}" class="btn btn-danger"><i class="bx bx-trash"></i></a>
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

@extends('permission.modal')
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
    <script>
    function editPermission(id){
        $.ajax({
            type:"GET",
            url: "{{ url('permission/edit') }}/"+id,
            success:function(response){
                $("#permission_id").val(response['id']);
                $("#permission_name").val(response['name']);
                $("#editpermission").modal('show');
            },
        });
    }
    </script>
@endpush
@endsection
