@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
            <div class="container-fluid">
            <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-start">
                    <h1 class="h3 mb-0 text-gray-800">Tambah Gallery</h1>
                    <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Back</a>
                </div>
                <div class="mb-3">
                    <small>Note: Upload gambar <b>Portrait</b></small>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-shadow">
                    <div class="card-body">
                        <form action="{{ route('gallery.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="travel_packages_id">Paket Travel</label>
                                <select name="travel_packages_id" required class="form-control">
                                    <option disabled selected>Pilih Paket Travel</option>
                                    @foreach ($travel_packages as $travel)
                                        <option value="{{ $travel->id }}">
                                            {{ $travel->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control" placeholder="Image">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                Save
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
@endsection