<x-admin>

@section('title','Create Role')

<section class="content">

<div class="container-fluid">

<div class="row justify-content-center">

<div class="col-lg-6 col-md-8 col-12">

<div class="card card-primary">

<div class="card-header d-flex justify-content-between align-items-center flex-wrap">

<h3 class="card-title mb-2">Create New Role</h3>

<div class="card-tools mb-2">

<a href="{{ route('admin.role.index') }}"
class="btn btn-sm btn-dark">

Back

</a>

</div>

</div>

<form action="{{ route('admin.role.store') }}"
method="POST"
class="needs-validation"
novalidate>

@csrf

<div class="card-body">

<div class="row">

<div class="col-12">

<div class="form-group">

<label for="name">Role Name</label>

<input type="text"
class="form-control"
name="name"
id="name"
value="{{ old('name') }}"
required>

<x-error>name</x-error>

<div class="invalid-feedback">
Role name field is required.
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