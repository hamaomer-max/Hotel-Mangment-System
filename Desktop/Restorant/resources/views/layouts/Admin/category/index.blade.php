@extends('layouts.admin')

@section('content')

<div class="container">
<div class="table-responsive mt-3">
<div class="table-wrapper mt-3 rounded">
<table id="myTable" class="table table-bordered">
    <thead>
      <tr>
        <th class="bg-dark text-light rounded text-center">No</th>
        <th class="bg-dark text-light rounded text-center">Name Kurdish</th>
        <th class="bg-dark text-light rounded text-center">Name English</th>
        <th class="bg-dark text-light rounded text-center">Name Arabic</th>
        <th class="bg-dark text-light rounded text-center">Image</th>
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
    ajax: "{{ route('admin.categories.index') }}",
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
      {data: 'name_ckb', name: 'name_ckb'},

      {data: 'name_en', name: 'name_en'},
      
      {data: 'name_ar', name: 'name_ar'},

      {data: 'full_path_image', name: 'full_path_image',orderable: false, searchable: false , render: function(data , type , row){
        return `<img src="${data}" width="50px" height="50px" />`;
      }},
   
      {data: 'created_at', name: 'created_at',orderable: false, searchable: false},
      {data: 'user.email', name: 'user.email'},
      {data: 'action', name: 'action', orderable: false, searchable: false , render: function(data , type , row){
        const id = row.id;
        const editUrl = '{{ route('admin.categories.edit', ':id') }}';
        const deleteUrl = '{{ route('admin.categories.destroy', ':id') }}';
        return `<a href="${editUrl.replace(':id', id)}" class="btn btn-sm btn-primary mb-2" style="width: 55px">Edit</a>
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