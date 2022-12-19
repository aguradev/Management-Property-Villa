@extends('backend.temp.temp')

@section('title', 'Create Category')

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

                    <form action="{{ route('categories-property.store') }}" method="POST" autocomplete="off" id="form">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="category_name">Category Name</label>
                            <input type="text" name="category_name" class="form-control"
                                placeholder="input category name">
                            @error('category_name')
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

                        <button type="submit" class="btn btn-primary">Create Data</button>

                    </form>

                </div>

            </div>

        </div>
    </div>


@endsection
