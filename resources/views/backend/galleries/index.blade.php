@extends('backend.temp.temp')

@section('title', 'Properties Gallery')

@section('content')
    <!-- Striped Rows -->

    <div id="flash-message" data-message="{{ session('flash_message') }}"></div>

    <div class="card">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-header">Property Galleries</h5>
            <div class="p-4">
                <a href="{{ route('properties-gallery.create') }}" class="btn btn-success">Add New</a>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">Property Villa</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($galleries as $data)
                        <tr class="data-table" data-id="{{ $data->PropertyVilla->property_villa_name }}">
                            <td class="text-center">{{ $galleries->firstItem() + $loop->index }}</td>
                            <td class="text-center">{{ $data->PropertyVilla->property_villa_name }}</td>
                            <td class="w-25">
                                <img src="{{ $images[$loop->index] }}" class="img-fluid">
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item btn-edit" data-bs-toggle="modal" data-bs-target="#editForm"
                                            data-id="{{ $data->id }}" href="javascript:void(0);"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <a class="dropdown-item btn-delete" data-id="{{ $data->id }}" href="#"><i
                                                class="bx bx-trash me-1"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $galleries->links() }}
            </div>

        </div>
    </div>


    <!--/ Striped Rows -->

    <div class="modal fade" id="editForm" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header pb-3">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="post" id="form" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="modal-body pt-0">
                        <div class="mb-3">

                            <label for="properties_villa" class="form-label">Select Property Villa</label>

                            <select name="properties_villa" id="properties-villa" class="form-control">

                                <option value="" disabled selected>--- Pilih Property Villa ---</option>

                            </select>

                            @error('properties_villa')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <div class="d-flex flex-column">
                                <label for="image" for="image" class="form-label">Upload Image</label>
                                <img class="img-fluid image_gallery mb-4" alt="image_gallery" style="width:50%;">
                            </div>
                            <div class="d-flex">
                                <input type="file" name="images" id="images" class="form-control">
                            </div>
                            @error('images')
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

    <script src="{{ asset('backend/assets/js/galleries-script.js') }}"></script>

@endsection
