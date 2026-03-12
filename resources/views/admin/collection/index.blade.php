<x-admin>
    @section('title','Collections')

    <div class="container-fluid">
        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h3 class="card-title mb-2">Collection Table</h3>

                <div class="card-tools mb-2">
                    <a href="{{ route('admin.collection.create') }}" class="btn btn-sm btn-info">
                        New
                    </a>
                </div>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped" id="collectionTable">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $collection)

                                <tr>

                                    <td>
                                        <img src="{{ asset('collection-image/' . $collection->image) }}"
                                             alt="{{ $collection->name }}"
                                             class="img-th img-fluid"
                                             loading="lazy">
                                    </td>

                                    <td>{{ $collection->name }}</td>

                                    <td>{{ $collection->category->name }}</td>

                                    <td class="d-flex flex-wrap gap-1">

                                        <a href="{{ route('admin.collection.edit', encrypt($collection->id)) }}"
                                           class="btn btn-sm btn-primary">
                                            Edit
                                        </a>

                                    </td>

                                    <td>

                                        <form action="{{ route('admin.collection.destroy', encrypt($collection->id)) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are sure want to delete?')">

                                            @method('DELETE')
                                            @csrf

                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Delete
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


    @section('css')

        <style>

            img.img-th{
                height:25px;
                width:auto;
            }

            @media (max-width:768px){

                img.img-th{
                    height:35px;
                }

            }

        </style>

    @endsection


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