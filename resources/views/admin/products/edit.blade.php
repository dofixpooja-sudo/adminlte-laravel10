<x-admin>

@section('title','Edit Product')

<div class="container-fluid">

<div class="row justify-content-center">

<div class="col-lg-10 col-md-12">

<div class="card">

<div class="card-header d-flex justify-content-between flex-wrap align-items-center">

<h3 class="card-title mb-2">Edit Product</h3>

<div class="card-tools mb-2">
<a href="{{ route('admin.product.index') }}" class="btn btn-info btn-sm">Back</a>
</div>

</div>

<form class="needs-validation"
novalidate
action="{{ route('admin.product.update', $data) }}"
method="POST"
enctype="multipart/form-data">

@method('PUT')
@csrf

<input type="hidden" name="id" value="{{ $data->id }}">

<div class="card-body">

<div class="row">

<div class="col-lg-6 col-md-6 col-12">
<div class="form-group">
<label for="name">Name</label>
<input type="text"
name="name"
id="name"
value="{{ $data->name }}"
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

<option value="" disabled>Select collection</option>

@foreach ($collection as $collect)

<option {{ $data->collection_id == $collect->id ? 'selected' : '' }}
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

<option disabled>Select the category</option>

@foreach ($category as $cat)

<option {{ $data->category_id == $cat->id ? 'selected' : '' }}
value="{{ $cat->id }}">

{{ $cat->name }}

</option>

@endforeach

</select>

<x-error>category</x-error>

</div>
</div>


<div class="col-lg-6 col-md-6 col-12">
<div class="form-group">

<label for="subcategory">Sub Category</label>

<select name="subcategory"
id="subcategory"
class="form-control">

@foreach ($subcategory as $item)

<option {{ $data->sub_category_id == $item->id ? 'selected' : '' }}
value="{{ $item->id }}">

{{ $item->name }}

</option>

@endforeach

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
class="form-control">

<a href="javascript:void(0)"
data-toggle="modal"
data-target="#modal-default">

View Image

</a>

<x-error>image</x-error>

</div>

</div>


<div class="col-lg-6 col-md-6 col-12">

<div class="form-group">

<label for="product-images">Product Slider Images</label>

<input type="file"
name="product_images[]"
id="product-images"
class="form-control"
multiple>

<x-error>product_images</x-error>

</div>

</div>


<div class="col-12">

<div class="row">

@foreach ($productImages as $productImage)

<div class="col-lg-2 col-md-3 col-4 mb-3">

<a href="{{ route('admin.remove.image', $productImage->id) }}"
onclick="return confirm('Are you sure want to remove image?')">

<img src="{{ asset('product-slider-images/' . $productImage->image) }}"
class="slider-img img-fluid">

</a>

</div>

@endforeach

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


<div class="modal fade" id="modal-default">

<div class="modal-dialog modal-dialog-centered">

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

<img src="{{ asset('product-image/' . $data->image) }}"
class="modal-img img-fluid">

<br>

<span class="text-muted">
If you want to change image just add new image otherwise leave it.
</span>

</div>

</div>

</div>

</div>


@section('css')

<style>

.modal-img{
width:100%;
height:auto;
object-fit:cover;
}

.slider-img{
width:100%;
max-width:120px;
height:auto;
object-fit:cover;
}

</style>

@endsection


@section('js')

<script>

$("#category").on('change', function(){

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

if(data){

$("#submit").removeAttr('disabled');

$("#submit").html('Save');

$("#subcategory").html(data);

}

}

});

});

</script>

@endsection

</x-admin>