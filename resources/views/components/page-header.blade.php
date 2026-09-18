@props([
    'title',
    'subtitle' => null,
    'icon' => null,
])

<section class="content-header sm-page-heading">
    <div class="container-fluid">
        <div class="sm-page-heading__inner">
            <div class="sm-page-heading__identity">
                @if ($icon)
                    <i class="{{ $icon }} sm-page-heading__lead-icon" aria-hidden="true"></i>
                @endif

                <div class="sm-page-heading__copy">
                    <h1 class="sm-page-heading__title">{{ $title }}</h1>

                    @if ($subtitle)
                        <p class="sm-page-heading__subtitle">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>

            @if (trim((string) $slot) !== '')
                <div class="sm-page-heading__actions">
                    {{ $slot }}
                </div>
            @endif
        </div>
    </div>
</section>
