<x-admin>

@section('title','Subcategories')

<div class="container-fluid">

<div class="card">

<div class="card-header d-flex justify-content-between align-items-center flex-wrap">

<h3 class="card-title mb-2">Sub Category Table</h3>

<div class="card-tools mb-2">
<a href="{{ route('admin.subcategory.create') }}" class="btn btn-sm btn-info">
New
</a>
</div>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-striped" id="subcategoryTable">

<thead>
<tr>
<th>Name</th>
<th>Action</th>
<th></th>
</tr>
</thead>

<tbody>

@foreach ($data as $cat)

<tr>

<td>{{ $cat->name }}</td>

<td>

<a href="{{ route('admin.subcategory.edit', encrypt($cat->id)) }}"
class="btn btn-sm btn-primary">

Edit

</a>

</td>

<td>

<form action="{{ route('admin.subcategory.destroy', encrypt($cat->id)) }}"
method="POST"
onsubmit="return confirm('Are sure want to delete?')">

@method('DELETE')
@csrf

<button type="submit"
class="btn btn-sm btn-danger">

Delete

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

$('#subcategoryTable').DataTable({

"paging": true,
"searching": true,
"ordering": true,
"responsive": true,

});

});

</script>

@endsection

</x-admin>