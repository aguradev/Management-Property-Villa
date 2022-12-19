@extends('backend.temp.temp')

@section('title', 'Create Galleries')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card mb-4">
                <div class="card-header">

                    <h4 class="mb-0">Form To Create Image Gallery</h4>

                </div>

                <div class="card-body">

                    <form action="{{ route('properties-gallery.store') }}" method="post" enctype="multipart/form-data"
                        id="form">

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
                            <div class="image-grid-list mb-3 d-flex flex-wrap gap-1 justify-content-center">
                            </div>
                            <label for="image" for="image" class="form-label">Upload Image</label>
                            <div class="d-flex">
                                <input type="file" name="images[]" id="images" class="form-control">
                                <button id="btn-add-form" class="btn btn-success">Add</button>
                            </div>
                            @error('images')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="btn btn-primary" id="btn-create-galleries" type="submit">Create Data Photo</button>

                    </form>

                </div>

            </div>

        </div>
    </div>

    <script src="{{ asset('backend/assets/js/galleries-script.js') }}"></script>

@endsection
