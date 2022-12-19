@extends('frontend.temp.temp')

@section('title', $propertiesVilla->property_villa_name)

@section('content')

    <section class="property-content">

        <div class="container property-galleries">

            <div class="row flex-lg-nowrap g-2">

                <div class="col-lg-6">

                    <img src="{{ $thumbnail }}" alt="{{ $propertiesVilla->property_villa_name . 'thumbnail' }}"
                        class="img-fluid">

                </div>

                <div class="col-lg-6">

                    <div class="row g-2">

                        @if ($galleries)
                            @for ($i = 0; $i < count($galleries); $i++)
                                <div class="col-lg-6">
                                    <img src="{{ $galleries[$i] }}"
                                        alt="{{ $propertiesVilla->property_villa_name . 'thumbnail' }}" class="img-fluid">
                                </div>
                            @endfor
                        @else
                            <div class="col-lg-6">
                                <img src="" alt="">
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>

        <div class="container property-description">

            <div class="row nowrap justify-content-center">

                <div class="col">

                    <div class="header-section">
                        <h1 class="display-1">{{ $propertiesVilla->property_villa_name }}</h1>
                        <p class="sub-text">{{ $propertiesVilla->category->category_name }}</p>
                    </div>

                    <div class="desc-paragraf">
                        <h4 class="header-text">Description</h4>
                        <p class="desc">{{ $propertiesVilla->description }}</p>
                    </div>

                    <div class="features">

                        <h4 class="header-text">Essential Features</h4>

                        <ul class="list-group flex-row gap-5">
                            @forelse ($propertiesVilla->features as $feature)
                                <li class="list-group-item border-0 p-0 bg-transparent font-weight-bold">
                                    {{ $feature->name_feature }}</li>
                            @empty
                                <p class="desc">No Features Available</p>
                            @endforelse
                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
