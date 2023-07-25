<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

class LoggedController extends Controller
{
    public function show($id) {


        $project = Project :: find($id);
        return view('logged.show', compact('project'));
    }
    public function create() {
        $types = Type :: all();
        $technologies = Technology :: all();
        return view('logged.create', compact('types', 'technologies'));
    }

    public function store(Request $request){
        $data = $request -> all();
        $project = Project :: create($data);
        $project -> technology() -> attach($data['technologies']);

        return redirect() -> route('logged.show', $project -> id);
    }
    public function edit($id){

        $project = Project :: find($id);
        $types = Type :: all();
        $technologies = Technology :: all();
        return view('logged.edit', compact('project', 'types',  'technologies'));
    }
    public function update(Request $request, $id){

        $data = $request -> all();

        $project = Project :: find($id);
        $project -> update($data);

        if (array_key_exists('technologies', $data)) {
            $project -> technology() -> sync($data['technologies']);
        } else {
            $project -> technology() -> detach();
        }

        return redirect() -> route('logged.show', $project -> id);
    }

    public function delete($id) {
        $project = Project :: find($id);
        $project -> delete();
        return redirect() -> route('guest.index');
    }
}
