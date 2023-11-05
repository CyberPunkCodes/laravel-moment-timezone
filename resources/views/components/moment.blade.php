<div>
    @if ($human)

        <time datetime="{{ $date->format($format) }}" {{ $attributes }}>
            {{ $date->diffForHumans() }}
        </time>

    @elseif ($local !== null)

        <span
            x-data="{
                formatLocalTimeZone: function (element, timestamp) {
                    const timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                    const date = moment.unix(timestamp).tz(timeZone);

                    element.innerHTML = date.format('{{ $local === true ? $format : 'M-D-YYYY [at] h:mm a (z)' }}');
                }
            }"
            x-init="formatLocalTimeZone($el, {{ $date->timestamp }})"
            title="{{ $date->diffForHumans() }}"
            {{ $attributes }}
        >
            {{ $date->format('n-j-Y \a\t g:i a \(T\)') }}
        </span>

    @else

        <span title="{{ $date->diffForHumans() }}" {{ $attributes }}>
            {{ $date->format($format) }}
        </span>

    @endif
</div>
