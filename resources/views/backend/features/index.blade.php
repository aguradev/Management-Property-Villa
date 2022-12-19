@extends('backend.temp.temp')

@section('title', 'Features Property Table')

@section('content')
    <div id="flash-message" data-message="{{ session('flash_message') }}"></div>

    <!-- Striped Rows -->
    <div class="card">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-header">Properties Features</h5>
            <div class="p-4">
                <a href="{{ route('properties-feature.create') }}" class="btn btn-success">Add New</a>
            </div>
        </div>
        <div class="text-nowrap">
            <table class="table table-striped mb-3">
                <thead>
                    <tr>
                        <th></th>
                        <th>Property Villa</th>
                        <th>Feature Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($dataView as $data)
                        <tr class="data-table">
                            <td>{{ $dataView->firstItem() + $loop->index }}</td>
                            <td><strong>{{ $data->propertyVilla->property_villa_name }}</strong></td>
                            <td>{{ $data->name_feature }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item btn-edit" data-bs-toggle="modal" data-bs-target="#editForm"
                                            href="#" data-id="{{ $data->id }}"><i class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <a class="dropdown-item btn-delete" href="#" data-id="{{ $data->id }}"><i
                                                class="bx bx-trash me-1"></i> Delete</a>
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

            <div class="d-flex justify-content-center">
                {{ $dataView->links() }}
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

                <form method="post" id="form">

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
                            <label class="form-label" for="name_feature">Name Feature</label>
                            <input type="text" name="name_feature" class="form-control" placeholder="input feature name">
                            @error('name_feature')
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

    <script src="{{ asset('backend/assets/js/features-edit-script.js') }}"></script>

@endsection
