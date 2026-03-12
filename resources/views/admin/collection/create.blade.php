<x-admin>
    @section('title','Create collection')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-primary">

                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                            <h3 class="card-title mb-2">Create Collection</h3>

                            <div class="card-tools mb-2">
                                <a href="{{ route('admin.collection.index') }}" class="btn btn-info btn-sm">
                                    Back
                                </a>
                            </div>
                        </div>

                        <form class="needs-validation" novalidate 
                              action="{{ route('admin.collection.store') }}" 
                              method="POST" 
                              enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text"
                                                   name="name"
                                                   id="name"
                                                   value="{{ old('name') }}"
                                                   class="form-control w-100"
                                                   required>
                                            <x-error>name</x-error>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <select name="category"
                                                    id="category"
                                                    class="form-control w-100"
                                                    required>
                                                <option value="" selected disabled>Select category</option>

                                                @foreach ($category as $cat)
                                                    <option {{ old($cat->id) == $cat->id ? 'selected' : '' }}
                                                            value="{{ $cat->id }}">
                                                        {{ $cat->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            <x-error>category</x-error>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file"
                                                   name="image"
                                                   id="image"
                                                   class="form-control w-100"
                                                   required>
                                            <x-error>image</x-error>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="Pdf" class="form-label">Pdf</label>
                                            <input type="file"
                                                   name="pdf"
                                                   id="Pdf"
                                                   class="form-control w-100"
                                                   required>
                                            <x-error>pdf</x-error>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin>