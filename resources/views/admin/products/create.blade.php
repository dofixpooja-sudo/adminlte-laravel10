<x-admin>
    @section('title')
        {{ 'Create Product' }}
    @endsection

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-10 col-md-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between flex-wrap align-items-center">
                    <h3 class="card-title mb-2">Create Product</h3>

                    <div class="card-tools mb-2">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-info btn-sm">
                            Back
                        </a>
                    </div>
                </div>

                <form class="needs-validation"
                      novalidate
                      action="{{ route('admin.product.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="card-body">

                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="name">Name</label>

                                    <input type="text"
                                           name="name"
                                           id="name"
                                           value="{{ old('name') }}"
                                           class="form-control"
                                           required>

                                    <x-error>name</x-error>
                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">

                                    <label for="collection">Collection</label>

                                    <select name="collection"
                                            id="collection"
                                            class="form-control"
                                            required>

                                        <option value="" selected disabled>
                                            Select collection
                                        </option>

                                        @foreach ($collection as $collect)

                                            <option {{ old($collect->id) == $collect->id ? 'selected' : '' }}
                                                    value="{{ $collect->id }}">

                                                {{ $collect->name }}

                                            </option>

                                        @endforeach

                                    </select>

                                    <x-error>collection</x-error>

                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6 col-12">

                                <div class="form-group">

                                    <label for="category">Category</label>

                                    <select name="category"
                                            id="category"
                                            class="form-control">

                                        <option value="" selected disabled>
                                            Select the category
                                        </option>

                                        @foreach ($category as $cat)

                                            <option {{ old($cat->id) == $cat->id ? 'selected' : '' }}
                                                    value="{{ $cat->id }}">

                                                {{ $cat->name }}

                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>


                            <div class="col-lg-6 col-md-6 col-12">

                                <div class="form-group">

                                    <label for="subcategory">Sub Category</label>

                                    <select name="subcategory"
                                            id="subcategory"
                                            class="form-control">

                                        <option value="" selected disabled>
                                            Select the subcategory
                                        </option>

                                    </select>

                                    <x-error>subcategory</x-error>

                                </div>

                            </div>


                            <div class="col-lg-6 col-md-6 col-12">

                                <div class="form-group">

                                    <label for="image">Image</label>

                                    <input type="file"
                                           name="image"
                                           id="image"
                                           class="form-control"
                                           required>

                                    <x-error>image</x-error>

                                </div>

                            </div>


                            <div class="col-lg-6 col-md-6 col-12">

                                <div class="form-group">

                                    <label for="product-images">
                                        Product Slider Images
                                    </label>

                                    <input type="file"
                                           name="product_images[]"
                                           id="product-images"
                                           class="form-control"
                                           multiple>

                                    <x-error>product_images</x-error>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer text-end">

                        <button type="submit"
                                id="submit"
                                class="btn btn-primary">

                            Save

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


@section('js')

<script>

$("#category").on('change', function() {

    let category = $("#category").val();

    $("#submit").attr('disabled','disabled');

    $("#submit").html('Please wait');

    $.ajax({

        url:"{{ route('admin.getsubcategory') }}",

        type:'GET',

        data:{
            category:category
        },

        success:function(data){

            $("#submit").removeAttr('disabled');

            $("#submit").html('Save');

            if(data){

                $("#subcategory").html(data);

            }

        }

    });

});

</script>

@endsection

</x-admin>