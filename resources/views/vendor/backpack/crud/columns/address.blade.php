@php
    $value = data_get($entry, $column['name']);
    $fields = $column['fields'] ?? ['value'];

    $address = json_decode($value);
    /*
     * {"name","administrative","country","countryCode","type","latlng":{"lat","lng"},"postcode","postcodes":["137455"],"value"}
     */
@endphp


{{-- Address --}}
<span>
@includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start')
@if (is_object($address))
    <address class="m-0">
        @foreach($fields as $field => $jump_line)
            @if (!$loop->first && $jump_line)
                <br>
            @endif
            @if (isset($address->$field))
                @if ((is_int($address->$field) || is_string($address->$field)))
                    {{$address->$field ?? ''}}
                @endif

                @if (is_array($address->$field))
                    @foreach($field as $key => $subfield)
                        {{$key}} : {{$subfield}}
                    @endforeach
                @endif

                @if (is_object($address->$field))
                    @foreach($address->$field as $key => $subfield)
                        {{$key}} : {{$subfield}}
                    @endforeach
                @endif
            @endif
        @endforeach
    </address>
@endif
@includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end')
</span>
