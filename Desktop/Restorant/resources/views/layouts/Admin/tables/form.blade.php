@extends('layouts.admin')

@section('content')

<div class="container">
<div class="container CustomBG shadow rounded mt-3 py-3">
    <a href="{{ route('admin.tables.index') }}" class="btn btn-success">Back</a>

    <form action="{{ isset($data) ? route('admin.tables.update', $data->id) : route('admin.tables.store') }}" method="POST" class="row">
    @csrf
    @isset($data)
    @method('PUT')
    @endisset
    
    <x-input title="Table Number" name="table_num" type="text" :dt=" isset($data) ? $data : false " />
    

    
    <x-button checkifupdate="{{ isset($data) ? true : false }}" />
    </form>
</div>
</div>

@endsection