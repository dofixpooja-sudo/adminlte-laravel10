<x-admin>
    @section('title','Add Questions')

    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- ADD QUESTION CARD --}}
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Question</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.category.index') }}" class="btn btn-info btn-sm">
                            Back
                        </a>
                    </div>
                </div>

                <form method="POST" action="/questions">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $categoryId }}">

                    <div class="card-body">
                        <div class="form-group">
                            <label>Question</label>
                            <input type="text"
                                   name="question"
                                   class="form-control"
                                   placeholder="Enter question">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">
                            Add Question
                        </button>
                    </div>
                </form>
            </div>

            {{-- QUESTIONS LIST CARD --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Questions List</h3>
                </div>

                <div class="card-body p-0">
                    <table class="table table-bordered table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width:5%">#</th>
                                <th>Question</th>
                                <th style="width:20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($questions as $q)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $q->question }}</td>
                                    <td>
                                        {{-- EDIT --}}
                                        <a href="{{ route('questions.edit', $q->id) }}"
                                           class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        {{-- DELETE --}}
                                        <form action="{{ route('questions.delete', $q->id) }}"
                                              method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this question?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        No questions found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-admin>
