<x-admin>
    @section('title','Edit Question')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="card card-primary">

                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                        <h3 class="card-title mb-2">Edit Question</h3>
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
                                       class="form-control w-100"
                                       value="{{ $question->question }}">
                            </div>

                        </div>

                        <div class="card-footer text-end">
                            <button class="btn btn-primary">
                                Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</x-admin>