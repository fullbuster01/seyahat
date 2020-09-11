@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
            <div class="container-fluid">
            <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h3 mb-0 text-gray-800">Tambah Thumb</h1>
                    <a href="{{ route('thumb.index') }}" class="btn btn-secondary">Back</a>
                </div>
                <div class="mb-3">
                    <small>Note: Upload gambar <b>Landscape</b></small>
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
                        <form action="{{ route('thumb.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="galleries_id">Paket Travel</label>
                                <select name="galleries_id" required class="form-control">
                                    <option disabled selected>Pilih ID Gallery Travel</option>
                                    @foreach ($galleries as $gallery)
                                        <option value="{{ $gallery->id }}">
                                            {{ $gallery->id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="thumb">Thumb</label>
                                <input type="file" name="thumb" class="form-control" placeholder="Image">
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