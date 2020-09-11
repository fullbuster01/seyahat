@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
            <div class="container-fluid">
            <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
                </div>

                <div class="row">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0" id="example-transaksi">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Travel</th>
                                        <th>User</th>
                                        <th>Visa</th>
                                        <th>Total</th>
                                        <th>Status</th>
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
            $('#example-transaksi').DataTable({
                processing: true,
                serverSider: true,
                ajax : {
                    url: "{{ route('transaction.ajax') }}",
                    type: 'GET'
                },
                columns : [
                    {data: 'id', name: 'id'} ,
                    {data: 'travel_id', name: 'travel_id'}, 
                    {data: 'user', name: 'user'} ,
                    {data: 'additional_visa', name: 'additional_visa'} ,
                    {data: 'transaction_total', name: 'transaction_total'} ,
                    {data: 'transaction_status', name: 'transaction_status'} ,
                    {data: 'action', name: 'action'} ,
                ],
                order : [[0, 'desc']] //ini untuk mengurutkan berdasarkan nama dari a-z
            });
        } );
    </script>
@endpush