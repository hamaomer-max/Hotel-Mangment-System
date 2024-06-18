@extends('layouts.admin')

@section('content')

<div class="container">
<div class="container CustomBG shadow rounded mt-3 py-3">
    <a href="{{ route('admin.users.index') }}" class="btn btn-success">Back</a>

    <form action="{{ isset($data) ? route('admin.users.update', $data->id) : route('admin.users.store') }}" method="POST" class="row">
    @csrf
    @isset($data)
    @method('PUT')
    @endisset
    
    <x-input title="Email" name="email" type="email" :dt=" isset($data) ? $data : false " />
    <x-input title="Password" name="password" type="password" :dt="false" />
    <x-input title="Password confirmation" name="password_confirmation" type="password" :dt="false" />
    

    <div class="col-md-4 mt-4 position-relative">
        <label for="name" class="form-label">role</label>
        <select name="role" id="" class="form-select">
            <option value=""></option>
            <option @selected(isset($data) ? $data->role == 1 : old('role') == 1) value="1">Admin</option>
            <option @selected(isset($data) ? $data->role == 2 : old('role') == 2) value="2">Service</option>
            <option @selected(isset($data) ? $data->role == 3 : old('role') == 3) value="3">Chef</option>
        </select>
    </div>
    
    <x-button checkifupdate="{{ isset($data) ? true : false }}" />
    </form>
</div>
</div>

@endsection