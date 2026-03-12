<x-admin>

@section('title','Edit Answer')

<div class="container-fluid mt-4">

<div class="row justify-content-center">

<div class="col-lg-6 col-md-8 col-12">

<div class="card">

<div class="card-header d-flex justify-content-between align-items-center flex-wrap">

<h5 class="mb-0">Edit Answer</h5>

</div>

<div class="card-body">

<form action="{{ route('admin.answer.update',$answer->id) }}" method="POST">

@csrf
@method('PUT')

@if($answer->answer_type == 'text')

<div class="form-group mb-3">

<label>Answer</label>

<input type="text"
name="answer_text"
class="form-control"
value="{{ $answer->answer_text }}">

</div>

@else

<div class="form-group mb-3">

<label>Select Option</label>

<select name="option_id" class="form-control">

@foreach($options as $option)

<option value="{{ $option->id }}"
{{ $answer->option_id == $option->id ? 'selected' : '' }}>

{{ $option->option_text }}

</option>

@endforeach

</select>

</div>

@endif


<div class="d-flex flex-wrap gap-2">

<button class="btn btn-success btn-sm">

Update

</button>

<a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">

Back

</a>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

</x-admin>