@extends('layouts.main')
@section('content')

@push('style')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
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
                    Role [ {{ $role->name }} ] Has Permission
                    <a href="javascript:;" onclick="check()" class="btn btn-primary" style="float:right">
                        <i class="bx bx-plus"></i> Select All
                    </a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('role.haspermissionupdate',$role->id) }}" method="post">
                    @csrf
                    <table class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions as $permission)
                            @php $checked = ""; @endphp
                            @foreach($rolePermissions as $rolePermission)
                                @if($permission->id == $rolePermission->id)
                                    @php
                                        $checked = "checked";
                                    @endphp
                                @endif
                            @endforeach
                            <tr>
                                <th>{{$permission->name}}</th>
                                <th>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input permissionCheckBox" type="checkbox" name="RolePermissionIds[]" value="{{ $permission->id }}"
                                            {{ $checked }}>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary waves-effect waves-float waves-light">Save</button>
                </form>
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
    <script>
        function check(){
            var ele=document.getElementsByName('RolePermissionIds[]');
            for(var i=0; i<ele.length; i++){
                if(ele[i].type=='checkbox')
                    ele[i].checked=true;
            }
        }
    </script>
@endpush
@endsection
