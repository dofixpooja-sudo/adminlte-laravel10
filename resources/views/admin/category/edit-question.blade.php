<x-admin>
    @section('title','Edit Question')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">

                <div class="card-header">
                    <h3 class="card-title">Edit Question</h3>
                </div>

                <form method="POST"
                      action="{{ route('questions.update', $question->id) }}">
                    @csrf
            <input type="hidden" name="category_id" value="{{ $question->category_id }}">

                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label>Question</label>
                            <input type="text"
                                   name="question"
                                   class="form-control"
                                   value="{{ $question->question }}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary float-right">
                            Update
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-admin>
