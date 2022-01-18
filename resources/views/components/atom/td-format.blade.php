@props(['align'=>''])
<td {{$attributes->merge(['class'=>'align-middle text-'.$align])}}>{{$slot}}</td>
