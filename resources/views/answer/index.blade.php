@extends('layouts.app')

@section('content')
<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Answers</h1>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Recent Answers</h6>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="answersTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Answer Type</th>
            <th>Answer</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($answers as $answer)
          <tr>
            <td>{{ $answer->id }}</td>
            <td>{{ $answer->question->question ?? '' }}</td>
            <td>{{ ucfirst($answer->answer_type) }}</td>
            <td>
              @if($answer->answer_type == 'text')
                {{ $answer->answer_text }}
              @else
                {{ $answer->option->option_text ?? '' }}
              @endif
            </td>
            <td>
              <a href="#" class="btn btn-sm btn-primary editBtn" data-id="{{ $answer->id }}">Edit</a>
              <a href="{{ route('answers.delete',$answer->id) }}" class="btn btn-sm btn-danger">Delete</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" id="editForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Edit Answer</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="answer_type" id="answer_type">
          <div class="form-group textAnswer">
            <label>Text Answer</label>
            <input type="text" name="answer_text" id="answer_text" class="form-control">
          </div>
          <div class="form-group optionAnswer">
            <label>Select Option</label>
            <select name="option_id" id="option_id" class="form-control">
              @foreach(App\Models\Option::all() as $opt)
                <option value="{{ $opt->id }}">{{ $opt->option_text }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function(){

  $('.editBtn').on('click', function(){
    var id = $(this).data('id');
    var type = $(this).closest('tr').find('td:eq(2)').text().toLowerCase();
    $('#editForm').attr('action', '/answers/update/'+id);
    $('#answer_type').val(type);

    if(type == 'text'){
      $('.textAnswer').show();
      $('.optionAnswer').hide();
      $('#answer_text').val($(this).closest('tr').find('td:eq(3)').text());
    }else{
      $('.textAnswer').hide();
      $('.optionAnswer').show();
      var optionText = $(this).closest('tr').find('td:eq(3)').text();
      $('#option_id option').filter(function(){ return $(this).text() == optionText; }).prop('selected', true);
    }

    $('#editModal').modal('show');
  });

});
</script>
@endsection