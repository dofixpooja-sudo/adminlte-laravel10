
<div class="row">
    @role('admin')

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $user }}</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $category }}</h3>
                <p>Total Categories</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $product }}</h3>
                <p>Total Products</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ $collection }}</h3>
                <p>Total Collections</p>
            </div>
        </div>
    </div>

    @endrole
</div>


<div class="row mt-4">
<div class="col-12">

<div class="card">

<div class="card-header bg-primary text-white">
<h3 class="card-title">Answers</h3>
</div>
<form method="GET" action="{{ url()->current() }}" class="mb-3 mt-3 ms-7">

<div class="row">

<div class="col-md-3">
<input type="text" name="user_id" class="form-control" placeholder="Search by User ID" value="{{ request('user_id') }}">
</div>

<div class="col-md-2">
<button type="submit" class="btn btn-primary">Search</button>
</div>

<div class="col-md-2">
<a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
</div>

</div>

</form>
<div class="card-body">

<table class="table table-bordered table-striped">

<thead>
<tr>
<th>#</th>
<th>User</th>
<th>Question</th>
<th>Answer</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>

<tbody>

@if(isset($answers) && count($answers) > 0)

@foreach($answers as $key => $answer)

<tr>

<td>{{ $key+1 }}</td>

<td>{{ $answer->user->name ?? 'N/A' }}</td>

<td>{{ $answer->question->question ?? 'N/A' }}</td>

<td>
@if($answer->answer_type == 'text')
{{ $answer->answer_text }}
@else
{{ $answer->option->option_text ?? 'N/A' }}
@endif
</td>

<td>{{ $answer->created_at->format('d M Y') }}</td>
<td>

<a href="{{ route('admin.answer.edit',$answer->id) }}" class="btn btn-sm btn-primary">
Edit
</a>

<form action="{{ route('admin.answer.destroy',$answer->id) }}" method="POST" style="display:inline-block;">
@csrf
@method('DELETE')

<button type="submit" class="btn btn-danger btn-sm"
onclick="return confirm('Delete this answer?')">
Delete
</button>

</form>

</form>

</form>

</td>
</tr>

@endforeach

@endif

</tbody>

</table>

</div>
</div>
</div>
</div>

