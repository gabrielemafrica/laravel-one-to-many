<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;


class LoggedController extends Controller
{
    // project
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
        // $data = $request -> validate([
        //     'nome' => 'required|string|max:255',
        //     'descrizione' => 'required|string',
        //     'link' => 'required|exists:types,id',
        //     'repo' => 'exists:technologies,id',
        //     'data' => 'exists:technologies,id'
        // ]);
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

        $project -> technology() -> detach();

        $project -> delete();
        return redirect() -> route('guest.index');
    }

    // types
    public function typeIndex() {

        $types = Type :: all();
        return view('logged.type.type-index', compact('types'));
    }
    public function typeCreate() {
        $projects = Project :: all();
        return view('logged.type.type-create', compact('projects'));
    }

    public function typeStore(Request $request){
        $data = $request -> all();
        $type = Type :: create($data);
        $projects = Project :: all();
        // assegno il nuovo type ia progetti che voglio
        foreach ($projects as $project) {
            if (in_array($project -> id, $data['projects'])) {
                $project -> type_id = $type -> id;
                $project -> save();
            }
        }
        return redirect() -> route('logged.typeShow', $type -> id);
    }

    public function typeEdit($id){
        $type = Type :: find($id);
        $projects = Project :: all();
        return view('logged.type.type-edit', compact('type', 'projects'));
    }

    public function typeUpdate(Request $request, $id){
        $data = $request -> all();
        $type = Type :: find($id);
        $type -> update($data);
        return redirect() -> route('logged.typeShow', $type -> id);
    }
    public function typeShow($id) {
        $types = Type :: all();
        $type = Type :: find($id);
        return view('logged.type.type-show', compact('type', 'types'));
    }
    public function typeDelete(Request $request, $id) {
        $data = $request -> all();
        $type = Type :: find($id);
        $projects = Project :: all();
        // assegno il nuovo type ia progetti che voglio
        foreach ($projects as $project) {
            if ($project -> type_id == $type -> id) {
                $project -> type_id = $data["type_id"];
                $project -> save();
            }
        }
        $type -> delete();
        return redirect() -> route('logged.typeIndex');
    }

    // technology
    public function technologyIndex() {

        $technologies = Technology :: all();
        return view('logged.technology.technology-index', compact('technologies'));
    }
    public function technologyCreate() {
        $projects = Project :: all();
        return view('logged.technology.technology-create', compact('projects'));
    }

    public function technologyStore(Request $request){
        $data = $request -> all();
        $technology = Technology :: create($data);
        $technology -> projects() -> attach($data['projects']);
        return redirect() -> route('logged.technologyShow', $technology -> id);
    }

    public function technologyEdit($id){
        $technology = Technology :: find($id);
        $projects = Project :: all();
        return view('logged.technology.technology-edit', compact('technology', 'projects'));
    }

    public function technologyUpdate(Request $request, $id){
        $data = $request -> all();
        $technology = Technology :: find($id);
        $technology -> update($data);

        if (array_key_exists('projects', $data)) {
            $technology -> projects() -> sync($data['projects']);
        } else {
            $technology -> projects() -> detach();
        }

        return redirect() -> route('logged.technologyShow', $technology -> id);
    }
    public function technologyShow($id) {

        $technology = Technology :: find($id);
        return view('logged.technology.technology-show', compact('technology'));
    }
    public function technologyDelete($id) {
        $technology = Technology :: find($id);

        $technology -> projects() -> detach();

        $technology -> delete();
        return redirect() -> route('logged.technologyIndex');
    }
}
