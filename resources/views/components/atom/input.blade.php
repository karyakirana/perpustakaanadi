@props(['name'])
<input type="text" {{$attributes}} class="form-control @error($name) is-invalid @enderror ">
@error($name)
<span class="invalid-feedback">{{$message}}</span>
@enderror
