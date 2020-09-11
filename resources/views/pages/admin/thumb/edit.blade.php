@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
            <div class="container-fluid">
            <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Edit Thumb</h1>
                    
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
                        <form action="{{ route('thumb.update', $item->id) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="galleries_id">Paket Travel</label>
                                <select name="galleries_id" class="form-control" required>
                                    <option value="{{ $item->galleries_id }}">Jangan Diubah</option>
                                    @foreach ($galleries as $travel)
                                        <option value="{{ $travel->id }}">
                                            {{ $travel->id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="thumb">Thumb</label>
                                <input type="file" name="thumb" class="form-control" placeholder="Image">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">
                                Update
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
@endsection