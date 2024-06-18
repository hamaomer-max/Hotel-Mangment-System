@extends('layouts.admin')

@section('content')

<div class="container">
<div class="container CustomBG shadow rounded mt-3 py-3">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-success">Back</a>

    <form action="{{ isset($data) ? route('admin.categories.update', $data->id) : route('admin.categories.store') }}" method="POST" class="row" enctype="multipart/form-data">
    @csrf
    @isset($data)
    @method('PUT')
    @endisset

    <x-input title="Name In Kurdish" name="name_ckb" type="text" :dt=" isset($data) ? $data : false " />
    <x-input title="Name In English" name="name_en" type="text" :dt=" isset($data) ? $data : false " />
    <x-input title="Name In Arabic" name="name_ar" type="text" :dt=" isset($data) ? $data : false " />
    <x-input title="Image" name="image" type="file" :dt=" isset($data) ? $data : false " />



   <x-button checkifupdate="{{ isset($data) ? true : false }}" />
    </form>
</div>
</div>

@endsection