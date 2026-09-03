@php
    $coresTema = $siteTheme['cores'] ?? \App\Support\ContentDefaults::paletaTema(\App\Support\ContentDefaults::tema()['paleta'])['cores'];
@endphp
<style>
    :root {
        --brand-highlight: {{ $coresTema[0] }};
        --brand-gray-light: {{ $coresTema[1] }};
        --brand-wine: {{ $coresTema[2] }};
        --brand-red-strong: {{ $coresTema[3] }};
        --brand-surface: {{ $coresTema[4] }};
        --brand-charcoal: {{ $coresTema[5] }};
        --brand-gray: {{ $coresTema[1] }};
        --bs-primary: {{ $coresTema[3] }};
        --bs-primary-rgb: {{ sscanf($coresTema[3], '#%02x%02x%02x')[0] }}, {{ sscanf($coresTema[3], '#%02x%02x%02x')[1] }}, {{ sscanf($coresTema[3], '#%02x%02x%02x')[2] }};
    }
</style>
