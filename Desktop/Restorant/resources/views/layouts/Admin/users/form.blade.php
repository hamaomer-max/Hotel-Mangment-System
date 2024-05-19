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
    <div class="col-md-4 mt-4 position-relative">
        <label for="name" class="form-label">Email</label>
        <input type="email" class="form-control" value="{{ isset($data) ? $data->email : old('email') }}" name="email">
    </div>
    <div class="col-md-4 mt-4 position-relative">
        <label for="name" class="form-label">password</label>
        <input type="password" class="form-control" value="" name="password">
    </div>
    <div class="col-md-4 mt-4 position-relative">
        <label for="name" class="form-label">password confirmation</label>
        <input type="password" class="form-control" value="" name="password_confirmation">
    </div>

    <div class="col-md-4 mt-4 position-relative">
        <label for="name" class="form-label">role</label>
        <select name="role" id="" class="form-select">
            <option value=""></option>
            <option @selected(isset($data) ? $data->role == 1 : old('role') == 1) value="1">Admin</option>
            <option @selected(isset($data) ? $data->role == 2 : old('role') == 2) value="2">Service</option>
            <option @selected(isset($data) ? $data->role == 3 : old('role') == 3) value="3">Chef</option>
        </select>
    </div>

    <div class="col-12">
        <button class="btn btn-success col-md-2 mt-4">
            @if (isset($data))
                <i class="bi bi-pencil"></i> update
                @else
                <i class="bi bi-plus"></i> create
            @endif
        </button>
    </div>
    </form>
</div>
</div>

@endsection