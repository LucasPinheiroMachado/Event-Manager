@extends('layouts.main')
@section('title', 'HDC Events')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>

<div id="events-container" class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            @if($search)
                <h2>Buscando por: {{ $search }}</h2>
            @else
                <h2>Próximos Eventos</h2>
                <p class="subtitle">Veja os eventos dos próximos dias</p>
            @endif
        </div>
    </div>
    <div id="cards-container" class="row justify-content-start">
        @foreach($events as $event)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 d-flex">
                <div class="card">
                    <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
                    <div class="card-body">
                        <p class="card-date">{{ date('d/m/y', strtotime($event->date)) }}</p>
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-participants">{{count($event->users)}} Participantes</p>
                        <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
                    </div>
                </div>
            </div>
        @endforeach
        @if(count($events) == 0 && $search)
            <p>Não foi possível encontrar nenhum evento com {{ $search }}</p>
        @elseif(count($events) == 0)
            <p>Não há eventos dísponiveis</p>
        @endif
    </div>
</div>


@endsection