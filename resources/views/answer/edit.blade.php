<x-admin>

@section('title','Edit Answer')

<div class="container mt-4">

<div class="card">
<div class="card-header">
Edit Answer
</div>

<div class="card-body">

<form action="{{ route('admin.answer.update',$answer->id) }}" method="POST">

@csrf
@method('PUT')

@if($answer->answer_type == 'text')

<label>Answer</label>
<input type="text"
name="answer_text"
class="form-control"
value="{{ $answer->answer_text }}">

@else

<label>Select Option</label>

<select name="option_id" class="form-control">

@foreach($options as $option)

<option value="{{ $option->id }}"
{{ $answer->option_id == $option->id ? 'selected' : '' }}>

{{ $option->option_text }}

</option>

@endforeach

</select>

@endif

<button class="btn btn-success mt-3">
Update
</button>

<a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">
Back
</a>

</form>

</div>
</div>

</div>

</x-admin>