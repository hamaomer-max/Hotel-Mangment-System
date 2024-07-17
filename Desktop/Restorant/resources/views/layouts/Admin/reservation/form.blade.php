@extends('layouts.admin')

@section('content')

<div class="container">
<div class="container CustomBG shadow rounded mt-3 py-3">

    <a href="{{ route('admin.ressrevations.show' , request('table_id')) }}" class="btn btn-success">Back</a>

    <form action="{{ isset($data) ? route('admin.ressrevations.update', ['ressrevation' => $data->id]) : route('admin.ressrevations.store') }}" method="POST" class="row" enctype="multipart/form-data">
        @csrf
        @isset($data)
            @method('PUT')
        @endisset

        <x-input title="Name" name="name" type="text" :dt="isset($data) ? $data : false" />
        <x-input title="Phone Number" name="phone_number" type="text" :dt="isset($data) ? $data : false" />
        <x-input title="Hour" name="hour" type="text" :dt="isset($data) ? $data : false" />
        <x-input title="Chair" name="chair" type="text" :dt="isset($data) ? $data : false" />
        <input type="hidden" name="table_id" value="{{ request('table_id') }}">

        <x-button checkifupdate="{{ isset($data) ? true : false }}" />
    </form>

</div>
</div>

@endsection