@props(['title'=>'', 'toolbar'=>'', 'footer'=>''])
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">{{$title}}</h3>
        </div>
        <div class="card-toolbar">
            {{ $toolbar }}
        </div>
    </div>
    <div class="card-body">
        {{$slot}}
    </div>
    <div class="card-footer text-right">
        {{ $footer }}
    </div>
</div>
