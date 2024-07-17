@extends('layouts.admin')

@section('content')

<div class="container">
<div class="table-responsive mt-3">
<div class="table-wrapper mt-3 rounded">
  <div class="d-flex justify-content-between">
    <h4>{{ $table->id }}</h4>
    <a href="{{ route('admin.ressrevations.create' , ['table_id' => $table->id]) }}" class="btn btn-success mb-2 me-2">
      <i class="fas fa-plus"></i> add
    </a>
  </div>
<table id="myTable" class="table table-bordered">
    <thead>
      <tr>
        <th class="bg-dark text-light rounded text-center">No</th>
        <th class="bg-dark text-light rounded text-center">Name</th>
        <th class="bg-dark text-light rounded text-center">Phone Number</th>
        <th class="bg-dark text-light rounded text-center">Hour</th>
        <th class="bg-dark text-light rounded text-center">Chair</th>
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
    ajax: "{{  route('admin.ressrevations.show', $table->id) }}",
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false}, 
      {data: 'name', name: 'name', orderable: false, searchable: true},

      {data: 'phone_number', name: 'phone_number' , orderable: false, searchable: true},

      {data: 'hour', name: 'hour'},

      {data: 'chair', name: 'chair'},
   
      {data: 'crated_at_readable', name: 'crated_at_readable',orderable: false, searchable: false},
      {data: 'user.email', name: 'user.email'},
      {data: 'action', name: 'action', orderable: false, searchable: false , render: function(data , type , row){
        const id = row.id;
        const editUrl = '{{ route('admin.ressrevations.edit', ['ressrevation'=>':id' , 'table_id' => $table->id]) }}';
        const deleteUrl = '{{ route('admin.ressrevations.destroy', ['ressrevation'=>':id' , 'table_id' => $table->id]) }}';
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