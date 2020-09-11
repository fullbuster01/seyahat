@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
            <div class="container-fluid">
            <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Edit Gallery</h1>
                    <a href="{{ route('gallery.index') }}" class="btn btn-secondary">Back</a>
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
                        <form action="{{ route('gallery.update', $item->id) }}" method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                {{-- <label for="travel_packages_id">Paket Travel</label>
                                <select name="travel_packages_id" class="form-control" required>
                                    <option value="{{ $item->travel_packages_id }}">{{ $item->travel_package->title }}</option>
                                    @foreach ($travel_packages as $travel)
                                        <option value="{{ $travel->id }}">
                                            {{ $travel->title }}
                                        </option>
                                    @endforeach
                                </select> --}}
                                <label for="travel">Paket Travel</label>
                                <input type="text" class="form-control" name="travel" id="travel" placeholder="Foods" value="{{ $item->travel_package->first()->title }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control" placeholder="Image">
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