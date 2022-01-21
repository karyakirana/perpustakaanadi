@props(['name'])
<input {{$attributes}} type="{{$type ?? 'text'}}"  class="form-control @error($name) is-invalid @enderror ">
@error($name)
<span class="invalid-feedback">{{$message}}</span>
@enderror
