<x-admin>
    @section('title','Edit collection')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 col-sm-12">

                <div class="card">
                    <div class="card-primary">

                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                            <h3 class="card-title mb-2">Edit Collection</h3>

                            <div class="card-tools mb-2">
                                <a href="{{ route('admin.collection.index') }}" class="btn btn-info btn-sm">
                                    Back
                                </a>
                            </div>
                        </div>

                        <form class="needs-validation"
                              novalidate
                              action="{{ route('admin.collection.update', $data) }}"
                              method="POST"
                              enctype="multipart/form-data">

                            @method('PUT')
                            @csrf

                            <input type="hidden" name="edit_id" value="{{ $data->id }}">

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Name</label>

                                            <input type="text"
                                                   name="name"
                                                   id="name"
                                                   value="{{ $data->name }}"
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

                                                <option value="" selected disabled>
                                                    Select category
                                                </option>

                                                @foreach ($category as $cat)
                                                    <option
                                                        {{ $data->category_id == $cat->id ? 'selected' : '' }}
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
                                                   class="form-control w-100">

                                            <x-error>image</x-error>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="Pdf" class="form-label">Pdf</label>

                                            <input type="file"
                                                   name="pdf"
                                                   id="Pdf"
                                                   class="form-control w-100">

                                            <x-error>pdf</x-error>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                        <button type="button"
                                                class="btn btn-default w-100"
                                                data-toggle="modal"
                                                data-target="#modal-default">
                                            View Image
                                        </button>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                        <button type="button"
                                                class="btn btn-default w-100"
                                                data-toggle="modal"
                                                data-target="#ViewPdf">
                                            View PDF
                                        </button>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- Image Modal --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">View Image</h4>

                    <button type="button"
                            class="close"
                            data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center">

                    <img src="{{ asset('collection-image/' . $data->image) }}"
                         class="img-fluid"
                         alt="">

                    <span class="text-muted d-block mt-2">
                        If you want to change image just add new image otherwise leave it.
                    </span>

                </div>

            </div>
        </div>
    </div>


    {{-- Pdf Modal --}}
    <div class="modal fade"
         id="ViewPdf"
         tabindex="-1">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        View PDF
                    </h5>

                    <button type="button"
                            class="close"
                            data-dismiss="modal">
                        <span>&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <iframe src="{{ asset('collection-pdf/' . $data->pdf) }}"
                            frameborder="0"
                            style="width:100%; height:500px;">
                    </iframe>

                    <span class="text-muted d-block mt-2">
                        If you want to change pdf just add new pdf otherwise leave it.
                    </span>

                </div>

            </div>

        </div>

    </div>


    @section('js')
        <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @endsection

</x-admin>