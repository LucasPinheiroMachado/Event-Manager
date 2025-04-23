@extends('layouts.main')
@section('dashboard', 'Evento')

@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus Eventos</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-events-container">
        @if(count($events) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Participantes</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr class="tr-my-events">
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                            <td style="position: relative;">
                                <div>{{count($event->users)}} <button class="all-users-btn"><i class="icon ion-chevron-down-outline"></i></button></div>
                                <div class="listUsers">
                                    @foreach($event->users as $user)
                                        <p class="userName">{{ $user->name }}</p>
                                    @endforeach
                                </div>
                            </td>
                            <td class="dash-btn-container">
                                <a href="/events/edit/{{ $event->id }}" class="btn btn-info" id="edit-btn"><i class="icon ion-create-outline"></i> Editar</a> 
                                <form action="/events/{{ $event->id }}" method="POST" class="form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" id="delete-btn"><i class="icon ion-trash-outline"></i> Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não tem eventos, <a href="/events/create">criar evento</a></p>
        @endif
    </div>

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Eventos que estou participando</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        @if(count($eventsasparticipant) > 0)
        <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Participantes</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventsasparticipant as $event)
                        <tr class="tr-my-events">
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                            <td>{{count($event->users)}}</td>
                            <td class="dash-btn-container">
                                <form action="/events/leave/{{ $event->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger delete-btn">
                                    <i class="icon ion-trash-outline"></i> Sair
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você não está participando de nenhum evento, <a href="/">veja todos os eventos</a></p>
        @endif
    </div>

    <div class="confirm-delete">
        <div class="box-confirm-delete">
            <h2>Tem certeza que deseja excluir esse evento?</h2>
            <div class="confirm-delete-btns">
                <button class="btn btn-danger btn-confirm-delete">Excluir</button>
                <button class="btn btn-info btn-cancel-delete">Cancelar</button>
            </div>
        </div>
    </div>

@endsection