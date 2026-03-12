<x-admin>

@section('title', 'Create User')

<div class="container-fluid">

<div class="card">

<div class="card-header d-flex justify-content-between align-items-center flex-wrap">

<h3 class="card-title mb-2">Create User</h3>

<div class="card-tools mb-2">
<a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-dark">
Back
</a>
</div>

</div>

<div class="card-body">

<form action="{{ route('admin.user.store') }}" method="POST">

@csrf

<div class="row">

<div class="col-lg-6 col-md-6 col-12">

<div class="form-group mb-3">

<label class="form-label">Name:*</label>

<input type="text"
class="form-control"
name="name"
required
value="{{ old('name') }}">

<x-error>name</x-error>

</div>

</div>


<div class="col-lg-6 col-md-6 col-12">

<div class="form-group mb-3">

<label class="form-label">Email:*</label>

<input type="email"
class="form-control"
name="email"
required
value="{{ old('email') }}">

<x-error>email</x-error>

</div>

</div>


<div class="col-lg-6 col-md-6 col-12">

<div class="form-group mb-3">

<label class="form-label">Password:*</label>

<input type="password"
class="form-control"
name="password"
required>

<x-error>password</x-error>

</div>

</div>


<div class="col-lg-6 col-md-6 col-12">

<div class="form-group mb-3">

<label class="form-label">Role:*</label>

<select name="role" class="form-control" required>

<option value="" disabled selected>Select the role</option>

@foreach ($roles as $role)

<option value="{{ $role->name }}"
{{ $role->name == old('role') ? 'selected' : '' }}>

{{ $role->name }}

</option>

@endforeach

</select>

<x-error>role</x-error>

</div>

</div>


<div class="col-12 text-right">

<button class="btn btn-primary btn-sm" type="submit">

Save

</button>

</div>

</div>

</form>

</div>

</div>

</div>

</x-admin>