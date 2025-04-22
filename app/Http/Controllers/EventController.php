<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;

use App\Models\Event;

use App\Models\User;

class EventController extends Controller
{
    public function index(){
        $search = request('search');

        if($search){

            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->orderBy('date', 'asc')->get();
            

        } else {
            $events = Event::orderBy('date')->get();
        }

        return view('welcome', ['events' => $events, 'search' => $search]);
    }
    

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){

        $event = new Event();

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        // Image

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id) {

        $event = Event::findOrFail($id);

        $user = auth()->user();

        $hasUserJoined = false;

        if ($user) {

            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent) {
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                }
            }

        }

        $eventOwner = User::where('id', '=', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);

    }    

    public function dashboard() {

        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', ['events' => $events, 'eventsasparticipant' => $eventsAsParticipant]);

    }

    public function destroy($id) {

        $user = auth()->user();

        $event = Event::findOrFail($id);

        if($user->id == $event->user_id){
            $event->delete();

            File::delete(public_path('img/events/' . $event->image));

            return redirect('/dashboard')->with('msg', 'Evento deletado com sucesso!');
        }

    }

    public function edit($id) {

        $event = Event::findOrFail($id);

        return view('events.edit', ['event' => $event]);

    }

    public function update(Request $request) {

        $user = auth()->user();

        $event = Event::findOrFail($request->id);

        $data = $request->all();

        if($user->id == $event->user_id){
            if($request->hasFile('image') && $request->file('image')->isValid()){
                $requestImage = $request->image;
                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);

                $requestImage->move(public_path('img/events'), $imageName);

                $data['image'] = $imageName;

                File::delete(public_path('img/events/' . $event->image));
            }

            Event::findOrFail($request->id)->update($data);

            return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
        }

    }

    public function joinEvent($id) {

        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/')->with('msg', 'Sua presença está confirmada no evento '. $event->title);

    }

    public function leaveEvent($id) {

        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença no evento '. $event->title. ' foi cancelada');

    }
}