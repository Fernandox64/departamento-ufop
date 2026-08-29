@php
    $iconesDisponiveis = [
        'fa-solid fa-building-columns' => 'Predio / instituicao',
        'fa-solid fa-users' => 'Pessoas / equipe',
        'fa-solid fa-file-lines' => 'Documento',
        'fa-solid fa-phone' => 'Telefone',
        'fa-solid fa-envelope' => 'E-mail',
        'fa-solid fa-clock' => 'Horario',
        'fa-solid fa-circle-check' => 'Confirmacao',
        'fa-solid fa-headset' => 'Atendimento',
        'fa-solid fa-calendar-days' => 'Agenda',
        'fa-solid fa-map-location-dot' => 'Localizacao',
        'fa-solid fa-gear' => 'Configuracao',
        'fa-solid fa-book' => 'Educacao',
        'fa-solid fa-shield-halved' => 'Seguranca',
        'fa-solid fa-graduation-cap' => 'Formatura / curso',
        'fa-solid fa-clipboard-check' => 'Processo / requerimento',
    ];
@endphp

@foreach($iconesDisponiveis as $classe => $rotulo)
    <option value="{{ $classe }}" @selected(($valorAtual ?? '') === $classe)>{{ $rotulo }}</option>
@endforeach
