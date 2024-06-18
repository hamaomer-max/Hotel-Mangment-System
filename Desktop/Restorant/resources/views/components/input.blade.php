<div class="col-md-4 mt-4 position-relative">
    <label for="{{ $name }}" class="form-label">{{ $title }}</label>
    <input type="{{ $type }}" class="form-control" value="{{ $dt ? $dt[$name] : old($name) }}" id="{{ $name }}" type="{{ $type }}" name="{{ $name }}">
</div>