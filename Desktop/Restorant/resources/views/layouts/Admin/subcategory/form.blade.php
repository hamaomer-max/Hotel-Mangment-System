@extends('layouts.admin')

@section('content')

<div class="container">
<div class="container CustomBG shadow rounded mt-3 py-3">
    <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-success">Back</a>

    <form action="{{ isset($data) ? route('admin.sub-categories.update', $data->id) : route('admin.sub-categories.store') }}" method="POST" class="row" enctype="multipart/form-data">
    @csrf
    @isset($data)
    @method('PUT')
    @endisset

    <x-input title="Name In Kurdish" name="name_ckb" type="text" :dt=" isset($data) ? $data : false " />
    <x-input title="Name In English" name="name_en" type="text" :dt=" isset($data) ? $data : false " />
    <x-input title="Name In Arabic" name="name_ar" type="text" :dt=" isset($data) ? $data : false " />
    <x-input title="Image" name="image" type="file" :dt=" isset($data) ? $data : false " />


    <div class="col-md-4 mt-4 position-relative">
        <label for="name" class="form-label">Category</label>
        <select name="category_id" id="" class="form-select">
            <option value="">
            @foreach ($categoris as $category)
                <option @selected(isset($data) ? ($category->id == $data->category->id ? true : false) : (old('category_id') == $category->id ? true : false)) value="{{ $category->id }}">{{ $category->name_en }}</option>
            @endforeach
            </option>
        </select>
    </div>

   <x-button checkifupdate="{{ isset($data) ? true : false }}" />
    </form>
</div>
</div>

@endsection