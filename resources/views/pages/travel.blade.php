@extends('layouts.app')

@section('title', 'Travel')

@push('prepend-style')
    <link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/xzoom.css') }}">
@endpush

@section('content')
    <main>
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active"><a href="{{ route('travels') }}">Paket Travel</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 pl-lg-0 mb-3">
                        <div class="card card-details">
                            <h1 class="text-center">Travels</h1>
                            <div class="travels row justify-content-center mt-4">
                                @forelse ($travels as $travel)
                                    <div class="col-sm-8 col-md-4 mr-5">
                                        <div class="card-travels text-center d-flex flex-column mx-auto"
                                            style="background-image: url('{{ $travel->galleries->count() ? Storage::url($travel->galleries->first()->l) : '' }}');background-repeat: no-repeat;background-size: cover">
                                            <div class="travel-location">{{ $travel->location }}</div>
                                            <div class="travel-title">{{ $travel->title }}</div>
                                            <div class="travel-button mt-auto">
                                                <a href="{{ route('detail', $travel->slug)}}" class="btn btn-travel-details px-4">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center">
                                        <h5>Travels Tidak ada</h5>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="d-flex justify-content-center page">
                            <div>
                                {{ $travels->links() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-details">
                            <h2>Category</h2>
                            <div class="category-widget">
                                <ul>
                                    @foreach ($categories as $category)
                                        @if ($category->travel_package->count())
                                            <li><a  href="{{ route('category', $category->slug) }}">{{ $category->name }}<span>{{ $category->travel_package->count() }}</span></a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <h2 class="mt-4">Country</h2>
                            <div class="row justify-content-between">
                                @forelse ($countries as $country)
                                    <div class="col-sm-6 col-6 text-center">
                                        <a href="{{ route('country', $country->slug) }}" class="btn btn-country px-2">{{ $country->name }}</a>
                                    </div>
                                @empty
                                    <h5>Country Tidak Ada</h5>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

