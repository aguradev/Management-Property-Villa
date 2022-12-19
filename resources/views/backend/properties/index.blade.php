@extends('backend.temp.temp')

@section('title', 'Properties Table')

@section('content')
    <!-- Striped Rows -->

    <div id="flash-message" data-message="{{ session('flash_message') }}"></div>

    <div class="card">
        <div class="d-flex align-items-center justify-content-between">
            <h5 class="card-header">Property Villa</h5>
            <div class="p-4">
                <a href="{{ route('properties-villa.create') }}" class="btn btn-success">Add New</a>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">Thumbnail</th>
                        <th>Properties Name</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($properties as $data)
                        <tr data-slug="{{ $data->slug }}">
                            <td>
                                {{-- nomor row tetap bertambah ketika berpindah halaman --}}
                                {{ $properties->firstItem() + $loop->index }}
                            </td>
                            <td class="w-25">
                                <img src="{{ $images[$loop->index] }}" alt="image-thumbnail" class="img-fluid"
                                    style="margin: 0 auto; display:block;">
                            </td>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $data->property_villa_name }}</strong>
                            </td>
                            <td>{{ $data->location }}</td>
                            <td><span class="text-success">Rp.{{ number_format($data->price) }}</span></td>
                            <td><span>{{ $data->category->category_name }}</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item btn-edit" data-bs-toggle="modal" data-bs-target="#editForm"
                                            data-slug="{{ $data->slug }}" href="javascript:void(0);"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <a class="dropdown-item btn-delete" data-slug="{{ $data->slug }}"
                                            href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="w-100 text-center" colspan="7">Data Not Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $properties->links() }}
            </div>

        </div>
    </div>

    <script src="{{ asset('backend/assets/js/properties-script.js') }}"></script>

    <!--/ Striped Rows -->

    <div class="modal fade" id="editForm" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 50em">

            <div class="modal-content">
                <div class="modal-header pb-4">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="#" method="post" id="form" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="modal-body pt-0">
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

                        <div class="mb-3 d-flex flex-column">
                            <label class="form-label" for="thumbnail">thumbnail</label>
                            <img class="img-fluid img_thumbnail mb-4" alt="img-thumbnail" style="width:50%;">
                            <input type="file" name="img_thumbnail" id="img-thumbnail" class="form-control">
                            @error('img_thumbnail')
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

@endsection
