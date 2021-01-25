<section class="card shadow {{ $className ?? '' }}">
    @isset($header)
        <div class="card-header">
            {{ $header }}
        </div>
    @endisset
        <div class="card-body">
            {{ $slot }}
        </div>
    @isset($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endisset