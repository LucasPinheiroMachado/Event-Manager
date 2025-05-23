@extends('layouts.main')
@section('title', 'Editar Evento')

@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Editando {{ $event->title }}</h1>
        <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="image">Imagem:</label>
                <input type="file" id="image" name="image" class="from-control-file">
                <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-preview">
            </div>

            <div class="form-group">
                <label for="title">Evento:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}">
            </div>

            <div class="form-group">
                <label for="date">Data:</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ \Illuminate\Support\Carbon::parse($event->date)->format('Y-m-d') }}">
            </div>

            <div class="form-group">
                <label for="city">Cidade:</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ $event->city }}">
            </div>

            <div class="form-group">
                <label for="private">O evento é privado?</label>
                <select name="private" id="private" class="form-control">
                    <option value="0">Não</option>
                    <option value="1" {{ $event->private == 1 ? "selected='selected'" : "" }}>Sim</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?">{{ $event->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="description">Adicione itens de infraestrutura:</label>

                @foreach (['Cadeiras', 'Palco', 'Cerveja Grátis', 'Open Food', 'Brindes'] as $item)
                    <div class="form-group">
                        <input
                            type="checkbox"
                            name="items[]"
                            value="{{ $item }}"
                            {{ in_array($item, $event->items ?? []) ? 'checked' : '' }}
                        > 
                        {{ $item }}
                    </div>
                @endforeach
            </div>

            <input type="submit" class="btn btn-primary" value="Editar Evento">
        </form>
    </div>

@endsection