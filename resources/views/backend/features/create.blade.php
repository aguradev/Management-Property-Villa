@extends('backend.temp.temp')

@section('title', 'Create Features')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card mb-4">
                <div class="card-header">

                    <h4 class="mb-0">Form Create Category</h4>

                    {{-- @if (session('flash_message'))
                        <div class="alert alert-success mt-3 mb-0">
                            <p class="mb-0">{{ session('flash_message') }}</p>
                        </div>
                    @endif --}}

                </div>

                <div class="card-body">

                    <form action="{{ route('properties-feature.store') }}" method="POST" autocomplete="off" id="form">

                        @csrf

                        <div class="mb-3">

                            <label for="properties_villa" class="form-label">Select Property Villa</label>

                            <select name="properties_villa" id="properties-villa" class="form-control">

                                <option value="" disabled selected>--- Pilih Property Villa ---</option>

                                @foreach ($villa as $data)
                                    <option value="{{ $data->slug }}">{{ $data->property_villa_name }}</option>
                                @endforeach

                            </select>

                            @error('properties_villa')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror

                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="name_feature">Name Feature</label>
                            <input type="text" name="name_feature" class="form-control" placeholder="input feature name">
                            @error('name_feature')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Data</button>

                    </form>

                </div>

            </div>

        </div>
    </div>


@endsection
