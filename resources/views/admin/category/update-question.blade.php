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
                            <select name="answer_type" class="form-control" required>
                                <option value="text"
                                    {{ $question->answer_type == 'text' ? 'selected' : '' }}>
                                    Text Answer
                                </option>

                                <option value="options"
                                    {{ $question->answer_type == 'options' ? 'selected' : '' }}>
                                    Options
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">
                            Update Question
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-admin>
