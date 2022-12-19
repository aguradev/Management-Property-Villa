@extends('frontend.temp.temp')

@section('title', 'Villa Property')

@section('content')

    <header class="hero-section">
        <div class="container">

            <div class="row">
                <div class="hero-title col-lg-10">
                    <h1 class="display-1">Our Property</h1>
                    <p class="desc">Building a next-generation collaborative platform to connect renters, homeowners, and
                        agents. Live the way you want. Beautiful homes. Incredible locations. Pricing that makes sense.
                    </p>
                </div>
            </div>

        </div>
    </header>

    <section class="properties-list">

        <div class="container">
            <div class="row g-4">


                @foreach ($villa as $content)
                    <div class="col-lg-4 mb-5">
                        <div class="card villa-content bg-transparent border-0">
                            <div class="villa-image">
                                <img src="{{ $villaImage[$loop->index] }}" class="card-img-top img-fluid">
                            </div>
                            <div class="card-body">
                                <p class="card-text">Rp. <span
                                        class="price-value">{{ number_format($content->price) }}</span>
                                </p>
                                <h2 class="card-title">{{ $content->property_villa_name }}</h2>
                                <a href="{{ route('frontend-property-detail', $content->slug) }}"
                                    class="btn border-0 rounded-0 p-0 bx-underline stretched-link border-bottom border-white mt-3">Room
                                    Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-center">
                    {{ $villa->links('vendor.pagination.custom') }}
                </div>

            </div>
        </div>

    </section>

@endsection
