@extends('layouts.main')
@section('title', 'Evento')

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/events/{{ $event->image }}" class="img-fluid" alt="{{ $event->title }}">
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{ $event->title }}</h1>
                <p class="event-city"> <i class="icon ion-location-outline"></i> {{ $event->city }}</p>
                <p class="event-date"> <i class="icon ion-calendar-outline"></i> {{ date('d/m/y', strtotime($event->date)) }} </p>
                <p class="events-participants"> <i class="icon ion-people-outline"></i> {{count($event->users)}} Participantes</p>
                <p class="event-owner"> <i class="icon ion-star-outline"></i> {{ $eventOwner['name'] }}</p>
                @if(!$hasUserJoined)
                    <form action="/events/join/{{ $event->id }}" method="POST">
                        @csrf
                        <a 
                        href="/events/join/{{ $event->id }}" 
                        class="btn btn-primary" 
                        id="event-submit"
                        onclick="event.preventDefault();
                        this.closest('form').submit();"
                        >Confirmar presença</a>
                    </form>
                @else
                    <p class="already-joined-msg">Você já está participando deste evento!</p>
                @endif
                <h3>O evento conta com:</h3>
                <ul id="items-list">
                    @foreach($event->items as $item)
                        <li> <i class="icon ion-play-outline"></i> <span>{{ $item }}</span></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-12" id="description-container">
                <h3>Sobre o evento:</h3>
                <p class="event-description">{{ $event->description }}</p>
            </div>
        </div>
    </div>

@endsection