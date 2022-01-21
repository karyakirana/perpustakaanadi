@props(['customAttributes' => ['class'=>'align-middle']])

<td {{ $attributes->merge($customAttributes) }}>
    {{ $slot }}
</td>
