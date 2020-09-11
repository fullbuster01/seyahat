@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
            <div class="container-fluid">
            <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Tambah Paket Travel</h1>
                    <a href="{{ route('travel-package.index') }}" class="btn btn-secondary">Back</a>
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
                        <form action="{{ route('travel-package.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option disabled selected>Plilih salah satu!</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ old('category_id') ?? $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="country_id">Country</label>
                                <select name="country_id" id="country_id" class="form-control">
                                    <option disabled selected>Plilih salah satu!</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ old('country_id') ?? $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                </select>
                                @error('country_id')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title') }}">
                                @error('title')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" name="location" placeholder="Location" value="{{ old('location') }}">
                                @error('location')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="about">About</label>
                                <textarea name="about" class="form-control">{{ old('about') }}</textarea>
                                @error('about')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="featured_event">Featured Event</label>
                                <input type="text" class="form-control" name="featured_event" placeholder="Featured Event" value="{{ old('featured_event') }}">
                                @error('featured_event')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="language">Language</label>
                                <input type="text" class="form-control" name="language" placeholder="Language" value="{{ old('language') }}">
                                @error('language')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="foods">Foods</label>
                                <input type="text" class="form-control" name="foods" placeholder="Foods" value="{{ old('foods') }}">
                                @error('foods')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="departure_date">Departure Date</label>
                                <input type="date" class="form-control" name="departure_date" placeholder="Departure Date" value="{{ old('departure_date') }}">
                                @error('departure_date')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="duration">Duration</label>
                                <input type="text" class="form-control" name="duration" placeholder="Duration" value="{{ old('duration') }}">
                                @error('duration')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type="text" class="form-control" name="type" placeholder="Type" value="{{ old('type') }}">
                                @error('type')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" name="price" placeholder="Price" value="{{ old('price') }}">
                                @error('price')
                                    <div class="text-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
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

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'about' );
    </script>
@endpush