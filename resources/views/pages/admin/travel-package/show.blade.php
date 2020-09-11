@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
            <div class="container-fluid">
            
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Detail Travel Package : {{ $item->title }}</h1>
                    <a href="{{ route('travel-package.index') }}" class="btn btn-secondary">Back</a>
                </div>

                <div class="row">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Durasi</th>
                                        <th>Price</th>
                                        <th>About</th>
                                        <th>View Travel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>{{ $item->country->name }}</th>
                                        <th>{{ $item->duration }}</th>
                                        <th>{{ $item->price }}</th>
                                        <th>{{ $item->about }}</th>
                                        <th><a href="{{ route('detail', $item->slug)}}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
@endsection