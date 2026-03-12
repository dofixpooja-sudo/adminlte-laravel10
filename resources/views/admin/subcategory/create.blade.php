<x-admin>

@section('title','Create subcategory')

<div class="container-fluid">

<div class="row justify-content-center">

<div class="col-lg-6 col-md-8 col-12">

<div class="card">

<div class="card-header d-flex justify-content-between align-items-center flex-wrap">

<h3 class="card-title mb-2">Create Sub Category</h3>

<div class="card-tools mb-2">
<a href="{{ route('admin.subcategory.index') }}" class="btn btn-info btn-sm">
Back
</a>
</div>

</div>

<form class="needs-validation"
novalidate
action="{{ route('admin.subcategory.store') }}"
method="POST">

@csrf

<div class="card-body">

<div class="form-group mb-3">

<label for="category">Select Category</label>

<select name="category"
id="category"
class="form-control"
required>

<option value="" disabled selected>
Select category
</option>

@foreach ($category as $cat)

<option value="{{ $cat->id }}">
{{ $cat->name }}
</option>

@endforeach

</select>

<x-error>category</x-error>

</div>


<div class="form-group mb-3">

<label for="name">Sub Category Name</label>

<input type="text"
class="form-control"
id="name"
name="name"
placeholder="Enter sub category name"
value="{{ old('name') }}"
required>

<x-error>name</x-error>

</div>

</div>

<div class="card-footer text-end">

<button type="submit"
class="btn btn-primary">

Save

</button>

</div>

</form>

</div>

</div>

</div>

</div>

</x-admin>