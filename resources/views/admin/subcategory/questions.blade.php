<x-admin>
@section('title','Add Questions')

<div class="container-fluid">

<div class="row justify-content-center">

<div class="col-lg-8 col-md-10 col-12">

{{-- ================= ADD QUESTION CARD ================= --}}
<div class="card card-primary">

<div class="card-header d-flex justify-content-between align-items-center flex-wrap">

<h3 class="card-title mb-2">Add Question</h3>

<div class="card-tools mb-2">
<a href="{{ route('admin.subcategory.index') }}" class="btn btn-info btn-sm">
Back
</a>
</div>

</div>

<form method="POST" action="{{ route('questions.store') }}">
@csrf

<input type="hidden" name="subcategory_id" value="{{ $subcategoryId }}">

<div class="card-body">

{{-- QUESTION --}}
<div class="form-group mb-3">
<label>Question</label>
<input type="text"
name="question"
class="form-control"
placeholder="Enter question"
required>
</div>

{{-- ANSWER TYPE --}}
<div class="form-group mb-3">
<label>Answer Type</label>
<select name="answer_type" id="answerType" class="form-control" required>
<option value="">Select Type</option>
<option value="text">Text</option>
<option value="options">Options</option>
</select>
</div>

{{-- Text Answer --}}
<div class="form-group mb-3" id="textAnswer" style="display:none">
<label>Answer</label>
<textarea name="text_answer" class="form-control"></textarea>
</div>

{{-- Options Answer --}}
<div class="form-group mb-3" id="optionAnswer" style="display:none">

<label>Options</label>

<div id="optionsWrapper">
<input type="text" name="options[]" class="form-control mb-2" placeholder="Option 1">
<input type="text" name="options[]" class="form-control mb-2" placeholder="Option 2">
</div>

<button type="button" id="addMore" class="btn btn-sm btn-secondary">
+ Add More
</button>

</div>

</div>

<div class="card-footer text-right">
<button type="submit" class="btn btn-primary btn-sm">
Add Question
</button>
</div>

</form>

</div>


{{-- ================= QUESTIONS LIST ================= --}}
<div class="card mt-4">

<div class="card-header">
<h3 class="card-title">Questions List</h3>
</div>

<div class="card-body">

@forelse($questions as $q)

<div class="border rounded p-3 mb-3">

<strong>Q:</strong> {{ $q->question }}

<p class="mt-2 text-muted">
<strong>Answer Type:</strong>
{{ ucfirst($q->answer_type) }}
</p>

<div class="d-flex flex-wrap gap-2 mt-2">

<a href="{{ route('questions.edit', $q->id) }}"
class="btn btn-sm btn-warning">
Edit
</a>

<form action="{{ route('questions.delete', $q->id) }}"
method="POST">
@csrf
@method('DELETE')

<button type="submit"
class="btn btn-sm btn-danger"
onclick="return confirm('Are you sure?')">
Delete
</button>

</form>

</div>

</div>

@empty

<p class="text-center text-muted">
No questions found
</p>

@endforelse

</div>

</div>

</div>

</div>

</div>


<script>

let answerType = document.getElementById('answerType');
let textAnswer = document.getElementById('textAnswer');
let optionAnswer = document.getElementById('optionAnswer');
let addMore = document.getElementById('addMore');
let optionsWrapper = document.getElementById('optionsWrapper');

answerType.addEventListener('change', function () {

textAnswer.style.display = (this.value === 'text') ? 'block' : 'none';
optionAnswer.style.display = (this.value === 'options') ? 'block' : 'none';

});

addMore.addEventListener('click', function () {

let inputCount = optionsWrapper.querySelectorAll('input').length + 1;

let input = document.createElement('input');

input.type = 'text';
input.name = 'options[]';
input.className = 'form-control mb-2';
input.placeholder = 'Option ' + inputCount;

optionsWrapper.appendChild(input);

});

</script>

</x-admin>