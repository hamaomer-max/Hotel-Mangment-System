@extends('layouts.admin')

@section('content')

<div class="container">
<div class="container CustomBG shadow rounded mt-3 py-3">
    <a href="{{ route('admin.foods.index' , ['sub_category' => request('sub_category')]) }}" class="btn btn-success">Back</a>

    <form action="{{ isset($data) ? route('admin.foods.update', $data->id) : route('admin.foods.store') }}" method="POST" class="row" enctype="multipart/form-data">
    @csrf
    @isset($data)
    @method('PUT')
    @endisset

    <x-input title="Name In Kurdish" name="name_ckb" type="text" :dt=" isset($data) ? $data : false " />
    <x-input title="Name In English" name="name_en" type="text" :dt=" isset($data) ? $data : false " />
    <x-input title="Name In Arabic" name="name_ar" type="text" :dt=" isset($data) ? $data : false " />
    <x-input title="Price" name="price" type="number" :dt=" isset($data) ? $data : false " />
    <input type="hidden" name="sub_category_id" value="{{ request('sub_category') }}">



   <x-button checkifupdate="{{ isset($data) ? true : false }}" />
    </form>
</div>
</div>

@endsection