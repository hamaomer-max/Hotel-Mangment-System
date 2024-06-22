@extends('layouts.admin')

@section('content')

<div class="container">
<div class="table-responsive mt-3">
<div class="table-wrapper mt-3 rounded">
  <div class="d-flex justify-content-between">
    <h4>{{ $sub_categoris->name_en }}</h4>
    <a href="{{ route('admin.foods.create' , ['sub_category' => request('sub_category')]) }}" class="btn btn-success mb-2 me-2">
      <i class="fas fa-plus"></i> add
    </a>
  </div>
<table id="myTable" class="table table-bordered">
    <thead>
      <tr>
        <th class="bg-dark text-light rounded text-center">No</th>
        <th class="bg-dark text-light rounded text-center">Name Kurdish</th>
        <th class="bg-dark text-light rounded text-center">Name English</th>
        <th class="bg-dark text-light rounded text-center">Name Arabic</th>
        <th class="bg-dark text-light rounded text-center">price</th>
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
    ajax: "{{ route('admin.foods.index') }}?sub_category={{ request('sub_category') }}",
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false}, 
      {data: 'name_ckb', name: 'name_ckb'},

      {data: 'name_en', name: 'name_en'},
      
      {data: 'name_ar', name: 'name_ar'},

      {data: 'price', name: 'price'},

   
      {data: 'crated_at_readable', name: 'crated_at_readable',orderable: false, searchable: false},
      {data: 'user.email', name: 'user.email'},
      {data: 'action', name: 'action', orderable: false, searchable: false , render: function(data , type , row){
        const id = row.id;
        const editUrl = '{{ route('admin.foods.edit', ':id') }}';
        const deleteUrl = '{{ route('admin.foods.destroy', ':id') }}';
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