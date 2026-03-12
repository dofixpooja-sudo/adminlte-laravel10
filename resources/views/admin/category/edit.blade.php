<x-admin>
    @section('title','Edit Category')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-primary">

                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                            <h3 class="card-title mb-2">Edit Category</h3>

                            <div class="card-tools mb-2">
                                <a href="{{ route('admin.category.index') }}" class="btn btn-info btn-sm">
                                    Back
                                </a>
                            </div>
                        </div>

                        <form class="needs-validation" novalidate action="{{ route('admin.category.update',$data) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text"
                                           class="form-control w-100"
                                           id="name"
                                           name="name"
                                           placeholder="Enter category name"
                                           required
                                           value="{{ $data->name }}">
                                </div>

                                <x-error>name</x-error>

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

</x-admin>