@extends('layouts.app')

@section('title', 'Detail Travel')

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
                                <li class="breadcrumb-item"><a href="{{ route('travels') }}">Paket Travel</a></li>
                                <li class="breadcrumb-item active">Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 pl-lg-0 mb-3">
                        <div class="card card-details">
                            <h5 class="text-center mb-3">{{ $items->category->name }} &middot; <small>{{ $items->country->name }}</small></h5>
                            <h1>{{ $items->title }}</h1>
                            <p>{{ $items->location }}</p>
                            @if ($items->thumb->count())
                                <div class="gallery">
                                    <div class="xzoom-container">
                                        <img src="{{ Storage::url($items->thumb->first()->thumb) }}" alt="Details" class="xzoom"
                                            id="xzoom-default" xoriginal="{{ Storage::url($items->thumb->first()->thumb) }}" width="660px"
                                            height="350px">
                                        <div class="xzoom-thumbs">
                                            @foreach ($items->thumb as $gallery)
                                                <a href="{{ Storage::url($gallery->thumb) }}">
                                                    <img src="{{ Storage::url($gallery->thumb) }}" alt="details"
                                                        class="xzoom-gallery" width="120" height="80"
                                                        xpreview="{{ Storage::url($gallery->thumb) }}">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <h2>Tentang Wisata</h2>
                            <p>{!! $items->about !!}</p>
                            <div class="features row">
                                <div class="col-md-4 mb-2">
                                    <img src="{{ url('frontend/images/ic_event.png') }}" alt="Event" class="features-image">
                                    <div class="description">
                                        <h3>Featured Event</h3>
                                        <p>{{ $items->featured_event }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <img src="{{ url('frontend/images/ic_language.png') }}" alt="Language" class="features-image">
                                    <div class="description">
                                        <h3>Language</h3>
                                        <p>{{ $items->language }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <img src="{{ url('frontend/images/ic_foods.png') }}" alt="Foods" class="features-image">
                                    <div class="description">
                                        <h3>Foods</h3>
                                        <p>{{ $items->foods }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-details card-right">
                            <h2>Members are going</h2>
                            <div class="members my-2">
                                <img src="{{ url('frontend/images/member-1.png') }}" alt="member-1" class="member-image mr-2">
                                <img src="{{ url('frontend/images/member-2.png') }}" alt="member-2" class="member-image mr-2">
                                <img src="{{ url('frontend/images/member-3.png') }}" alt="member-3" class="member-image mr-2">
                                <img src="{{ url('frontend/images/member-4.png') }}" alt="member-4" class="member-image mr-2">
                                <img src="{{ url('frontend/images/member-5.png') }}" alt="member++" class="member-image">
                            </div>
                            <hr>
                            <h2>Trip Informations</h2>
                            <table class="trip-informations">
                                <tr>
                                    <th>Date of Departure</th>
                                    <td class="text-right">{{ \Carbon\Carbon::now()->addDays(14)->format('F d, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Duration</th>
                                    <td class="text-right">{{ $items->duration }}</td>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <td class="text-right">{{ $items->type }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td class="text-right">${{ $items->price }},00 / person</td>
                                </tr>
                            </table>
                        </div>
                        <div class="join-container">
                            @auth
                                <form action="{{ route('checkout_process', $items->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-block btn-join-now mt-3 py-2">Join Now</button>
                                </form>
                            @endauth

                            @guest
                                <a href="{{ route('login') }}" class="btn btn-block btn-join-now mt-3 py-2">Login Or Register to Join</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('addon-script')
    <script src="{{ url('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(".xzoom, .xzoom-gallery").xzoom({
                zoomWidth: 500,
                title: false,
                tint: '#333', //ini warna untuk title
                Xoffset: 15
            });
        })
    </script>
@endpush

