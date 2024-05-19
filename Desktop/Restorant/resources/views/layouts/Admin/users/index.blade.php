@extends('layouts.admin')

@section('content')

<div class="container">
<div class="table-responsive mt-3">
<div class="table-wrapper mt-3 rounded">
<table id="myTable" class="table table-bordered">
    <thead>
      <tr>
        <th class="bg-dark text-light rounded text-center">No</th>
        <th class="bg-dark text-light rounded text-center">Email</th>
        <th class="bg-dark text-light rounded text-center">role</th>
        <th class="bg-dark text-light rounded text-center">Created At</th>
        <th class="bg-dark text-light rounded text-center">Created By</th>
        <th class="bg-dark text-light rounded text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
</div>
<script src="https:cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function() {
  let table = $('#myTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('admin.users.index') }}",
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
      {data: 'email', name: 'email'},
      {data: 'role', name: 'role',orderable: false, searchable: false},
      {data: 'crated_at_readable', name: 'crated_at_readable',orderable: false, searchable: false},
      {data: 'user.email', name: 'user.email'},
      {data: 'action', name: 'action', orderable: false, searchable: false , render: function(data , type , row){
        const id = row.id;
        const editUrl = '{{ route('admin.users.edit', ':id') }}';
        const deleteUrl = '{{ route('admin.users.destroy', ':id') }}';
        return `<a href="${editUrl.replace(':id', id)}" class="btn btn-primary"><i class="bi bi-pencil"></i></a>
        <form id='${id}' action="${deleteUrl.replace(':id', id)}" method="POST">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
         <button type="button" onclick="deleteFunction('${id}')" class="btn btn-sm btn-danger">Delete</button>
         </form>
        `;
      }},
    ]
  });
});
</script>
</div>
</div>
@endsection