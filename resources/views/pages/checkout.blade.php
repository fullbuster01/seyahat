@extends('layouts.checkout')

@section('title', 'Checkout')

@push('prepend-style')
    <link rel="stylesheet" href="{{ url('frontend/libraries/gijgo/css/gijgo.min.css') }}">
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
                                <li class="breadcrumb-item">Paket Travel</li>
                                <li class="breadcrumb-item">Details</li>
                                <li class="breadcrumb-item active">Chekout</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 pl-lg-0 mb-3">
                        <div class="card card-details">
                            @if ($errors->any())
                            <div class="alert alert-adanger">
                                <ul>
                                    @foreach ($errors as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <h1>Who is Going?</h1>
                            <p>Trip to {{ $item->travel_package->title }} , {{ $item->travel_package->location }}</p>
                            <div class="attendee">
                                <table class="table table-responsive-sm text-center">
                                    <thead>
                                        <tr>
                                            <td>Picture</td>
                                            <td>Username</td>
                                            <td>Name</td>
                                            <td>Nationality</td>
                                            <td>Visa</td>
                                            <td>Passport</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($item->details as $detail)
                                            {{-- @foreach ($item as $i) --}}
                                            {{-- @if ($detail->transaction->transaction_status == 'IN_CART' && auth()->user()->id == $detail->transaction->id ) --}}
                                                
                                            <tr>
                                                <td><img src="https://ui-avatars.com/api/?name={{ $detail->username }}" alt="avatar1" class="rounded-circle" width="60" height="60"></td>
                                                <td class="align-middle">{{ $detail->username }}</td>
                                                @foreach ($users as $user)
                                                    @if ($detail->username == $user->username)
                                                        <td class="align-middle">{{ $user->name }}</td>
                                                    @endif
                                                @endforeach
                                                <td class="align-middle">{{ $detail->nationality }}</td>
                                                <td class="align-middle">{{ $detail->is_visa ? '30Days' : 'N/A'}}</td>
                                                <td class="align-middle">{{ \Carbon\Carbon::createFromDate($detail->doe_passport) > \Carbon\Carbon::now() ? 'Active' : 'Inactive' }}</td>
                                                <td class="align-middle">
                                                    <a href="{{ route('checkout_remove', $detail->id) }}"><img src="{{ url('frontend/images/ic_remove.png') }}" alt="tombol remove"></a>
                                                </td>
                                            </tr>
                                            {{-- @endif --}}
                                            {{-- @endforeach --}}
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No Visitor</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="member mt-3">
                                <h2>Add Member</h2>
                                <form class="form-inline" method="POST" action="{{ route('checkout_create', $item->id) }}">
                                    @csrf
                                    <label for="username" class="sr-only">Username</label>
                                    <input type="text" name="username" class="form-control mb-2 mr-sm-2"
                                        id="username" placeholder="Username" required>

                                    <label for="nationality" class="sr-only">Nationality</label>
                                    <input type="text" name="nationality" class="form-control mb-2 mr-sm-2"
                                        id="nationality" placeholder="Nationality" style="width: 50px" required>

                                    <label for="is_visa" class="sr-only">VISA</label>
                                    <select name="is_visa" id="is_visa" class="custom-select mb-2 mr-sm-2" required>
                                        <option value="" selected>VISA</option>
                                        <option value="1">30 Days</option>
                                        <option value="0">N/A</option>
                                    </select>

                                    <label for="doe_passport" class="sr-only">DOE PASSPORT</label>
                                    <div class="form-control mb-2 mr-sm-2">
                                        <input type="text" name="doe_passport" class="input-group datepicker border-bottom-0  border-0" id="doe_passport" placeholder="DOE Passport">
                                    </div>

                                    <button type="submit" class="btn btn-add mb-2 px-4">Add Now</button>
                                </form>
                                <h3 class="mt-2 mb-0">Note</h3>
                                <p class="disclaimer mb-0">You are only able to invite member that has registered in Seyahat.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-details card-right">
                            <h2 class="mb-2">Checkout Informations</h2>
                            
                            <table class="trip-informations">
                                <tr>
                                    <th>Members</th>
                                    <td class="text-right">{{ $item->details->count() }} person</td>
                                </tr>
                                <tr>
                                    <th>Additional Visa</th>
                                    <td class="text-right">${{ $item->additional_visa }},00</td>
                                </tr>
                                <tr>
                                    <th>Trip Price</th>
                                    <td class="text-right">${{ $item->travel_package->price }} / person</td>
                                </tr>
                                <tr>
                                    <th>Sub Total</th>
                                    <td class="text-right">${{ $item->transaction_total }},00</td>
                                </tr>
                                <tr>
                                    <th>Total (+Unique Code)</th>
                                    <td class="text-right text-total">
                                        <span class="text-blue">${{ $item->transaction_total }},</span><span class="text-orange">{{ mt_rand(0,99) }}</span>
                                    </td>
                                </tr>
                            </table>
                            <hr>
                            <h2 class="my-3">Payment Instructions</h2>
                            <p class="instruc mb-3">Please complete your payment before to
                            continue the wonderful trip</p>
                            <div class="bank mb-3">
                                <img src="{{ url('frontend/images/ic_bank.png') }}" alt="" class="float-left">
                                <div class="content float-left ml-3">
                                    <p>PT Seyahat ID</p>
                                    <p>0808-0808-0808</p>
                                    <p>Bank Central Asia</p>
                                </div>
                            </div>
                            <div class="bank">
                                <img src="{{ url('frontend/images/ic_bank.png') }}" alt="" class="float-left">
                                <div class="content float-left ml-3">
                                    <p>PT Seyahat ID</p>
                                    <p>0808-0808-0808</p>
                                    <p>Bank HSBC</p>
                                </div>
                            </div>
                        </div>
                        <div class="join-container">
                            <a href="{{ route('checkout_success', $item->id) }}" class="btn btn-block btn-join-now payment mt-3 py-2">I Have Made Payment</a>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('detail', $item->travel_package->slug) }}" class="text-muted">Cancel Booking</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


@push('addon-script')
    <script src="{{ url('frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                uilibrary: 'bootstrap4',
                icons: {
                    rightIcon: '<img src="{{ url('frontend/images/ic_doe.png') }}" alt="doe">'
                }
            });
        })
    </script>
@endpush