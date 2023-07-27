<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

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
        // dd($data);

        // $data = $request -> validate(
        //        $this -> getValidations(),
        //        $this -> getValidationMessages()
        // );
        // dd($data);
        // archivio img e prondo il path
        // $data['main_picture'] = Storage::put('uploads', $data['main_picture']);
        $img_path = Storage::put('uploads', $data['main_picture']);
        $data['main_picture'] = $img_path;

        $project = Project :: create($data);
        $project -> technology() -> attach($data['technologies']);

        return redirect() -> route('logged.show', $project -> id);
    }
    public function edit($id){

        $types = Type :: all();
        $technologies = Technology :: all();

        $project = Project :: find($id);

        return view('logged.edit', compact('project', 'types',  'technologies'));
    }
    public function update(Request $request, $id){

        $data = $request -> all();
        // dd($data);

        $project = Project :: find($id);
        $oldImgPath = $project -> main_picture;
        if (!array_key_exists("main_picture", $data)) {
            $data['main_picture'] = $oldImgPath;
        }else{
            if ($project -> main_picture){
                Storage::delete($oldImgPath);
            }
            $newImgPath = Storage::put('uploads', $data['main_picture']);
            $data['main_picture'] = $newImgPath;
        }

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

        $img_path = $project->main_picture;

        $project -> technology() -> detach();
        $project -> delete();

        if ($img_path && Storage::exists($img_path)) {
            Storage::delete($img_path);
        }

        return redirect() -> route('guest.index');
    }
    public function deleteImg($id) {
        $project = Project :: find($id);
        // ottengo il percorso dell'img
        $img_path = $project->main_picture;

        $project -> main_picture = null;
        $project -> save();
        // elimino fisicamento l'img
        Storage::delete($img_path);

        return back();
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

    // private functions validation
    private function getValidations() {

        return [
            'nome' => 'required|string|max:255',
            'descrizione' => 'required|string',
            'link' => 'required|string|min:5',
            'repo' => 'required|string|min:5',
            'data' => 'requred|date',
            "main_picture" => "nullable|file|image|max:2048"
        ];
    }
    private function getValidationMessages() {

        return [
            'nome.max' => 'aggiusta il nome',
            'descrizione.required' => 'aggiusta il dato',
            'link.required' => 'aggiusta il dato',
            'repo.required' => 'aggiusta il dato',
            'data.required' => 'aggiusta il dato',
            "main_picture.max" => "aggiusta il dato"
        ];
    }
}
