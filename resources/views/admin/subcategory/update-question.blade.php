<x-admin>
    @section('title','Update Question')

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Question</h3>
                </div>

                <form method="POST" action="{{ route('questions.update', $question->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        {{-- QUESTION --}}
                        <div class="form-group">
                            <label>Question</label>
                            <input type="text"
                                   name="question"
                                   class="form-control"
                                   value="{{ $question->question }}"
                                   required>
                        </div>

                        {{-- ANSWER TYPE --}}
                        <div class="form-group">
                            <label>Answer Type</label>
                            <select name="answer_type" id="answerType" class="form-control" required>
                                <option value="text" {{ $question->answer_type=='text' ? 'selected' : '' }}>Text Answer</option>
                                <option value="options" {{ $question->answer_type=='options' ? 'selected' : '' }}>Options</option>
                            </select>
                        </div>

                        {{-- TEXT ANSWER --}}
                        <div class="form-group" id="textAnswer" style="{{ $question->answer_type=='text' ? '' : 'display:none' }}">
                            <label>Answer</label>
                            <textarea name="text_answer" class="form-control">{{ $question->answers?->first()?->answer ?? '' }}</textarea>
                        </div>

                        {{-- OPTIONS --}}
                        <div class="form-group" id="optionAnswer" style="{{ $question->answer_type=='options' ? '' : 'display:none' }}">
                            <label>Options</label>
                            <div id="optionsWrapper">
                                @foreach($question->answers ?? [] as $ans)
                                    <input type="text" name="options[]" class="form-control mb-2" value="{{ $ans->answer }}">
                                @endforeach
                                {{-- Extra empty input for new options --}}
                                <input type="text" name="options[]" class="form-control mb-2" placeholder="Option">
                            </div>
                            <button type="button" id="addMore" class="btn btn-sm btn-secondary">+ Add More</button>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Update Question</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    {{-- JS show/hide answer type & Add More --}}
    <script>
        let answerType = document.getElementById('answerType');
        let textAnswer = document.getElementById('textAnswer');
        let optionAnswer = document.getElementById('optionAnswer');
        let addMore = document.getElementById('addMore');
        let optionsWrapper = document.getElementById('optionsWrapper');

        // Show/hide Text or Options fields
        answerType.addEventListener('change', function() {
            textAnswer.style.display = this.value === 'text' ? 'block' : 'none';
            optionAnswer.style.display = this.value === 'options' ? 'block' : 'none';
        });

        // Add More functionality
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
