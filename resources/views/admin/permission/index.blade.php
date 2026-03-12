<x-admin>
    @section('title','Permissions')

    <div class="container-fluid">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">

                <h3 class="card-title mb-2">Permission</h3>

                <div class="card-tools mb-2">
                    <a href="{{ route('admin.permission.create') }}" class="btn btn-sm btn-primary">
                        Add
                    </a>
                </div>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-striped" id="collectionTable">

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Created</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($data as $permission)

                                <tr>

                                    <td>{{ $permission->name }}</td>

                                    <td>{{ $permission->created_at }}</td>

                                    <td class="d-flex flex-wrap gap-1">

                                        <a href="{{ route('admin.permission.edit', encrypt($permission->id)) }}"
                                           class="btn btn-sm btn-secondary">
                                            <i class="far fa-edit"></i>
                                        </a>

                                    </td>

                                    <td>

                                        <form action="{{ route('admin.permission.destroy', encrypt($permission->id)) }}"
                                              method="POST"
                                              onclick="confirm('Are you sure')">

                                            @method('DELETE')
                                            @csrf

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="text-center bg-danger">
                                        Permission not created
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>


    @section('js')

        <script>
            $(function() {

                $('#collectionTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });

            });
        </script>

    @endsection

</x-admin>