@extends('frontend.temp.temp')

@section('title', 'Villa Project')

@section('content')
    <header class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <img src="{{ asset('images/hero-img-1.jpg') }}" alt="hero-img-1" class="img-fluid img-hero">
                </div>
                <div class="col">
                    <img src="{{ asset('images/hero-img-2.jpg') }}" alt="hero-img-1" class="img-fluid img-hero">
                </div>
                <div class="col">
                    <img src="{{ asset('images/hero-img-3.jpg') }}" alt="hero-img-1" class="img-fluid img-hero">
                </div>
                <div class="col">
                    <img src="{{ asset('images/hero-img-4.jpg') }}" alt="hero-img-1" class="img-fluid img-hero">
                </div>
            </div>

            <div class="row">
                <div class="hero-title col-lg-10">
                    <h1 class="display-1">Home is where your story begins</h1>
                    <p class="desc">Building a next-generation collaborative platform to connect renters, homeowners, and
                        agents. Live the way you want. Beautiful homes. Incredible locations. Pricing that makes sense.
                    </p>
                </div>
            </div>

        </div>
    </header>

    <main class="main-content">

        <section class="reputations">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="display-2">Trusted by the people across the globe</h2>
                    </div>
                    <div class="col-lg-5">
                        <p class="desc">Building a next-generation collaborative platform to connect renters, homeowners,
                            and agents. Live the way you want. Beautiful homes. Incredible locations.Pricing that
                            makes
                            sense.</p>
                        <p class="desc">No matter what stage of life you’re in, having friends to share experiences with
                            is what it’s all
                            about.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="galleries">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <img src="{{ asset('images/image-content.png') }}" alt="hero-img-1" class="img-fluid">
                    </div>
                    <div class="col-lg-5">
                        <h2 class="display-2">
                            Providing the effective solutions for you
                        </h2>
                        <p class="desc">
                            Building a next-generation collaborative platform to connect renters, homeowners, and agents.
                            Live the way you want. Beautiful homes. Incredible locations. Pricing that makes sense.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="villa-properties">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h2 class="display-2">Popular property</h2>
                        <p class="desc">Building a next-generation collaborative platform to connect renters,
                            homeowners,
                            and agents.</p>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row properties flex-nowrap gap-1">

                    @foreach ($villa as $content)
                        <div class="col-lg-4">
                            <div class="card villa-content bg-transparent border-0">
                                <div class="villa-image">
                                    <img src="{{ $villaImage[$loop->index] }}" class="card-img-top img-fluid">
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Rp. <span
                                            class="price-value">{{ number_format($content->price) }}</span></p>
                                    <h5 class="card-title">{{ $content->property_villa_name }}</h5>
                                    <a href="{{ route('frontend-property-detail', $content->slug) }}"
                                        class="btn border-0 rounded-0 p-0 bx-underline stretched-link border-bottom border-dark mt-3">Room
                                        Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


        </section>

    </main>

@endsection
