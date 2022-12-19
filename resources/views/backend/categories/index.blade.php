@extends('backend.temp.temp')

@section('title', 'Categories Property Table')


@section('content')

    <div id="flash-message" data-message="{{ session('flash_message') }}"></div>

    <!-- Striped Rows -->
    <div class="card">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-header">Categories Property</h5>
            <div class="p-4">
                <a href="{{ route('categories-property.create') }}" class="btn btn-success">Add New</a>
            </div>
        </div>
        <div class="text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($dataView as $data)
                        <tr data-slug="{{ $data->slug }}">
                            <td>{{ $no++ }}</td>
                            <td><strong>{{ $data->category_name }}</strong></td>
                            <td>{{ $data->description }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item btn-edit" data-bs-toggle="modal" data-bs-target="#editForm"
                                            href="#" data-slug="{{ $data->slug }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item btn-delete" href="#"
                                            data-slug="{{ $data->slug }}"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5">Data Not Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Striped Rows -->

    <div class="modal fade" id="editForm" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="#" method="post" id="form">

                    @csrf
                    @method('PUT')

                    <div class="modal-body">
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
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>

        </div>
    </div>

    <script src="{{ asset('backend/assets/js/category-script.js') }}"></script>

@endsection
