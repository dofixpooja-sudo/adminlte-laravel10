<x-admin>
    @section('title','Category')

    <div class="container-fluid">
        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h3 class="card-title mb-2">Category Table</h3>

                <div class="card-tools mb-2">
                    <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-info">
                        New
                    </a>
                </div>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped" id="categoryTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($data as $cat)
                                <tr>

                                    <td>{{ $cat->name }}</td>

                                    <td class="d-flex flex-wrap gap-1">
                                        <a href="{{ route('admin.category.edit', encrypt($cat->id)) }}"
                                           class="btn btn-sm btn-primary">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.category.destroy', encrypt($cat->id)) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure want to delete?')"
                                              style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </td>

                                    <td>
                                        <form action="{{ route('admin.category.toggleStatus', $cat->id) }}"
                                              method="POST">
                                            @csrf

                                            <button type="submit"
                                                class="btn btn-sm {{ $cat->status ? 'btn-success' : 'btn-secondary' }}">
                                                {{ $cat->status ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @section('js')

    <script>
        $(document).ready(function() {
            $('.toggle-status').click(function() {
                var btn = $(this);
                var categoryId = btn.data('id');

                $.ajax({
                    url: '/admin/category/' + categoryId + '/toggle-status',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.status) {
                            btn.removeClass('btn-danger').addClass('btn-success').text('Active');
                        } else {
                            btn.removeClass('btn-success').addClass('btn-danger').text('Inactive');
                        }
                    },
                    error: function(xhr){
                        alert('Something went wrong!');
                    }
                });
            });
        });
    </script>

    <script>
        $(function() {
            $('#categoryTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "responsive": true,
            });
        });
    </script>

    @endsection

</x-admin>