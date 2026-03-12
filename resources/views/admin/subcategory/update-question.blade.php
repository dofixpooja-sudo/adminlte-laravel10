<x-admin>

@section('title','Update Question')

<div class="container-fluid">

<div class="row justify-content-center">

<div class="col-lg-8 col-md-10 col-12">

<div class="card card-primary">

<div class="card-header d-flex justify-content-between align-items-center flex-wrap">

<h3 class="card-title mb-2">Update Question</h3>

</div>

<form method="POST" action="{{ route('questions.update', $question->id) }}">

@csrf
@method('PUT')

<div class="card-body">

{{-- QUESTION --}}
<div class="form-group mb-3">

<label>Question</label>

<input type="text"
name="question"
class="form-control"
value="{{ $question->question }}"
required>

</div>


{{-- ANSWER TYPE --}}
<div class="form-group mb-3">

<label>Answer Type</label>

<select name="answer_type" id="answerType" class="form-control" required>

<option value="text"
{{ $question->answer_type=='text' ? 'selected' : '' }}>

Text Answer

</option>

<option value="options"
{{ $question->answer_type=='options' ? 'selected' : '' }}>

Options

</option>

</select>

</div>


{{-- TEXT ANSWER --}}
<div class="form-group mb-3"
id="textAnswer"
style="{{ $question->answer_type=='text' ? '' : 'display:none' }}">

<label>Answer</label>

<textarea name="text_answer"
class="form-control">

{{ $question->answers?->first()?->answer ?? '' }}

</textarea>

</div>


{{-- OPTIONS --}}
<div class="form-group mb-3"
id="optionAnswer"
style="{{ $question->answer_type=='options' ? '' : 'display:none' }}">

<label>Options</label>

<div id="optionsWrapper">

@foreach($question->answers ?? [] as $ans)

<input type="text"
name="options[]"
class="form-control mb-2"
value="{{ $ans->answer }}">

@endforeach


<input type="text"
name="options[]"
class="form-control mb-2"
placeholder="Option">

</div>

<button type="button"
id="addMore"
class="btn btn-sm btn-secondary">

+ Add More

</button>

</div>

</div>


<div class="card-footer text-right">

<button type="submit"
class="btn btn-primary btn-sm">

Update Question

</button>

</div>

</form>

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

answerType.addEventListener('change', function() {

textAnswer.style.display = this.value === 'text' ? 'block' : 'none';

optionAnswer.style.display = this.value === 'options' ? 'block' : 'none';

});


addMore.addEventListener('click', function() {

let input = document.createElement('input');

input.type = 'text';
input.name = 'options[]';
input.className = 'form-control mb-2';
input.placeholder = 'Option';

optionsWrapper.appendChild(input);

});

</script>

</x-admin>