@extends('backend.temp.temp')

@section('title', 'Create Property')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card mb-4">
                <div class="card-header">

                    <h4 class="mb-0">Form Create Property</h4>

                </div>

                <div class="card-body">

                    <form action="{{ route('properties-villa.store') }}" enctype="multipart/form-data" method="POST"
                        autocomplete="off" id="form">

                        @csrf

                        <div class="row mb-3">
                            <div class="col">
                                <div>
                                    <label class="form-label" for="property_villa_name">Property Name</label>
                                    <input type="text" name="property_villa_name" class="form-control"
                                        placeholder="input property name">
                                    @error('property_villa_name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col">
                                <div>
                                    <label class="form-label" for="location">location</label>
                                    <input type="text" name="location" class="form-control" placeholder="input location">
                                    @error('location')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="category">category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="" disabled selected>--- pilih kategori ---</option>

                                @foreach ($dataCategories as $category)
                                    <option value="{{ $category->slug }}">{{ $category->category_name }}</option>
                                @endforeach

                            </select>
                            @error('category')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="location">price</label>
                            <input type="number" name="price" class="form-control" placeholder="input price">
                            @error('price')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="description">Description</label>
                            <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Description here..."></textarea>
                            @error('description')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="thumbnail">thumbnail</label>
                            <input type="file" name="img_thumbnail" id="img-thumbnail" class="form-control">
                            @error('img_thumbnail')
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
