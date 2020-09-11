@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
            <div class="container-fluid">
            <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Gallery</h1>
                    <a href="{{ route('gallery.create') }}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50">Tambah Gallery</i></a>
                </div>

                <div class="row">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0" id="example-gallery">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Travel</th>
                                        <th>Gambar</th>
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
            $('#example-gallery').DataTable({
                processing: true,
                serverSider: true,
                ajax : {
                    url: "{{ route('gallery.ajax') }}",
                    type: 'GET'
                },
                columns : [
                    {data: 'id', name: 'id'} ,
                    {data: 'travel_id', name: 'travel_id'}, 
                    {data: 'img', name: 'gambar'} ,
                    {data: 'action', name: 'action'} ,
                ],
                order : [[0, 'desc']] //ini untuk mengurutkan berdasarkan nama dari a-z
            });
        } );
    </script>
@endpush