<x-admin>
    @section('title','Edit Permission')

    <section class="content">

        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-lg-6 col-md-8 col-sm-12">

                    <div class="card card-primary">

                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                            
                            <h3 class="card-title mb-2">Edit Permission</h3>

                            <div class="card-tools mb-2">
                                <a href="{{ route('admin.permission.index') }}"
                                   class="btn btn-sm btn-dark">
                                    Back
                                </a>
                            </div>

                        </div>

                        <form action="{{ route('admin.permission.store') }}"
                              method="POST"
                              class="needs-validation"
                              novalidate>

                            @csrf

                            <input type="hidden" name="id" value="{{ $data->id }}">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-12">

                                        <div class="form-group">

                                            <label for="name" class="form-label">
                                                Permission Name
                                            </label>

                                            <input type="text"
                                                   class="form-control w-100"
                                                   name="name"
                                                   id="name"
                                                   required
                                                   value="{{ $data->name }}">

                                            <x-error>name</x-error>

                                            <div class="invalid-feedback">
                                                Permission name field is required.
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="card-footer text-end">

                                <button type="submit"
                                        id="submit"
                                        class="btn btn-primary">
                                    Submit
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

</x-admin>