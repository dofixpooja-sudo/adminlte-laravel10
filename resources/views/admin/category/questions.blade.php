<x-admin>
    @section('title','Add Questions')

    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- ADD QUESTION CARD --}}
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Question</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.category.index') }}" class="btn btn-info btn-sm">Back</a>
                    </div>
                </div>

                <form method="POST" action="{{ route('questions.store') }}">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $categoryId }}">

                    <div class="card-body">
                        <div class="form-group">
                            <label>Question</label>
                            <input type="text" name="question" class="form-control" placeholder="Enter question" required>
                        </div>

                        <div class="form-group">
<div class="form-group">
    <label>Answer Type</label>
    <select name="answer_type" id="answerType" class="form-control" required>
        <option value="">Select Type</option>
        <option value="text">Text</option>
        <option value="options">Options</option>
    </select>
</div>

<div class="form-group" id="optionAnswer" style="display:none">
    <label>Options</label>

    <div id="optionsWrapper">
        <input type="text" class="form-control mb-2" placeholder="Option 1">
        <input type="text" class="form-control mb-2" placeholder="Option 2">
    </div>

    <button type="button" id="addMore" class="btn btn-sm btn-secondary">
        + Add More
    </button>
</div>



                        <div class="form-group" id="textAnswer" style="display:none">
                            <label>Answer</label>
                            <textarea name="text_answer" class="form-control"></textarea>
                        </div>

                        <div class="form-group" id="optionAnswer" style="display:none">
                            <label>Options</label>
                            <input type="text" name="options[]" class="form-control mb-2" placeholder="Option 1">
                            <input type="text" name="options[]" class="form-control mb-2" placeholder="Option 2">
                            <input type="text" name="options[]" class="form-control mb-2" placeholder="Option 3">
                            <input type="text" name="options[]" class="form-control mb-2" placeholder="Option 4">
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Add Question</button>
                    </div>
                </form>
            </div>

            {{-- QUESTIONS LIST CARD --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Questions List</h3>
                </div>

                <div class="card-body">
              @forelse($questions as $q)
    <div class="border rounded p-3 mb-3">
        <strong>Q:</strong> {{ $q->question }}

        <p class="mt-2 text-muted">
            <strong>Answer Type:</strong> {{ ucfirst($q->answer_type) }}
        </p>

        <div class="mt-2">
            <a href="{{ route('questions.edit', $q->id) }}" class="btn btn-sm btn-warning">Edit</a>

            <form action="{{ route('questions.delete', $q->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure?')">
                    Delete
                </button>
            </form>
        </div>
    </div>
@empty
    <p class="text-center text-muted">No questions found</p>
@endforelse

                </div>
            </div>

        </div>
    </div>

  
   <script>
let answerType = document.getElementById('answerType');
let optionAnswer = document.getElementById('optionAnswer');
let addMore = document.getElementById('addMore');
let optionsWrapper = document.getElementById('optionsWrapper');

answerType.addEventListener('change', function () {
    optionAnswer.style.display = (this.value === 'options') ? 'block' : 'none';
});

addMore.addEventListener('click', function () {
    let input = document.createElement('input');
    input.type = 'text';
    input.className = 'form-control mb-2';
    input.placeholder = 'Option';
    optionsWrapper.appendChild(input);
});
</script>

</x-admin>
