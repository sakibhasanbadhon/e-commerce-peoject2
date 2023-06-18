@extends('layouts.admin')
@section('styles')
<style>
    tr td:last-child{
        text-align: right;
    }
</style>

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header p-3">
                        <h4 class=" d-flex justify-content-between"> Pages List
                            <a href="{{ route('admin.page.create') }}" id="add_btn" class="btn btn-outline-primary">Add</a>
                        </h4>

                    </div>
                    <div class="card-body">
                        <table class="table table-sm" id="category-datatables">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Page Name</th>
                                    <th>Page Title</th>
                                    <th>created_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pages as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->page_name }}</td>
                                        <td>{{ $item->page_title }}</td>
                                        <td>{{ date('d-M-y', strtotime($item->created_at)) }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.page.edit',$item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.page.destroy',$item->id) }}" id="delete-form-{{ $item->id }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                            </form>
                                            <button type="button" onclick="sweetAlert({{ $item->id }})"  class="btn btn-danger btn-sm"> delete</button>
                                        </td>

                                    </tr>
                                @empty
                                    <div class="text-danger">Nothing To Show</div>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

        function sweetAlert(delete_id){
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm'

                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-'+delete_id).submit();


                    }
            })
            }



    </script>
@endpush


