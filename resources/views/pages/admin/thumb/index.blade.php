@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
            <div class="container-fluid">
            <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Thumb</h1>
                    <a href="{{ route('thumb.create') }}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50">Tambah thumb</i></a>
                </div>

                <div class="row">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0" id="example-thumb">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Gallery Travel</th>
                                        <th>Thumb</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endpush
@push('addon-script')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example-thumb').DataTable({
                processing: true,
                serverSider: true,
                ajax : {
                    url: "{{ route('thumb.ajax') }}",
                    type: 'GET'
                },
                columns : [
                    {data: 'id', name: 'id'} ,
                    {data: 'gallery_id', name: 'galery_id'}, 
                    {data: 'thumb', name: 'thumb'} ,
                    {data: 'action', name: 'action'} ,
                ],
                order : [[0, 'desc']] //ini untuk mengurutkan berdasarkan nama dari a-z
            });
        } );
    </script>
@endpush