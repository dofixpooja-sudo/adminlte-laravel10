<x-admin>

@section('title','Roles')

<div class="container-fluid">

<div class="card">

<div class="card-header d-flex justify-content-between align-items-center flex-wrap">

<h3 class="card-title mb-2">Roles</h3>

<div class="card-tools mb-2">
<a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-primary">
Add
</a>
</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-striped" id="roleTable">

<thead>

<tr>
<th>Name</th>
<th>Created</th>
<th>Action</th>
<th></th>
</tr>

</thead>

<tbody>

@foreach ($data as $role)

<tr>

<td>{{ $role->name }}</td>

<td>{{ $role->created_at }}</td>

<td>

<a href="{{ route('admin.role.edit',encrypt($role->id)) }}"
class="btn btn-sm btn-secondary">

<i class="far fa-edit"></i>

</a>

</td>

<td>

<form action="{{ route('admin.role.destroy',encrypt($role->id)) }}"
method="POST"
onsubmit="return confirm('Are you sure')">

@method('DELETE')
@csrf

<button type="submit"
class="btn btn-sm btn-danger">

<i class="fas fa-trash-alt"></i>

</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

</div>

</div>


@section('js')

<script>

$(function() {

$('#roleTable').DataTable({

"paging": true,
"searching": true,
"ordering": true,
"responsive": true,

});

});

</script>

@endsection

</x-admin>