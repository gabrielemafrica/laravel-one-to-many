<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

class LoggedController extends Controller
{
    // Visualizza un singolo progetto
    public function show($id) {
        $project = Project::find($id);
        return view('logged.show', compact('project'));
    }

    // Mostra il form per creare un nuovo progetto
    public function create() {
        $types = Type::all();
        $technologies = Technology::all();
        return view('logged.create', compact('types', 'technologies'));
    }

    // Salva il nuovo progetto nel database
    public function store(Request $request){
        $data = $request->all();
        // dd($data);

        // $data = $request -> validate(
        //        $this -> getValidations(),
        //        $this -> getValidationMessages()
        // );
        // dd($data);
        // archivio img e prondo il path
        // $data['main_picture'] = Storage::put('uploads', $data['main_picture']);

        // Carica l'immagine e ottieni il percorso
        $img_path = Storage::put('uploads', $data['main_picture']);
        $data['main_picture'] = $img_path;

        $project = Project::create($data);
        $project->technology()->attach($data['technologies']);

        return redirect()->route('logged.show', $project->id);
    }

    // Mostra il form per modificare un progetto esistente
    public function edit($id){
        $types = Type::all();
        $technologies = Technology::all();
        $project = Project::find($id);
        return view('logged.edit', compact('project', 'types', 'technologies'));
    }

    // Aggiorna i dati di un progetto nel database
    public function update(Request $request, $id){
        $data = $request->all();
        $project = Project::find($id);
        $oldImgPath = $project->main_picture;

        if (!array_key_exists("main_picture", $data)) {
            $data['main_picture'] = $oldImgPath;
        } else {
            if ($project->main_picture){
                Storage::delete($oldImgPath);
            }
            $newImgPath = Storage::put('uploads', $data['main_picture']);
            $data['main_picture'] = $newImgPath;
        }

        $project->update($data);

        if (array_key_exists('technologies', $data)) {
            $project->technology()->sync($data['technologies']);
        } else {
            $project->technology()->detach();
        }

        return redirect()->route('logged.show', $project->id);
    }

    // Elimina un progetto dal database e l'immagine associata, se presente
    public function delete($id) {
        $project = Project::find($id);
        $img_path = $project->main_picture;

        $project->technology()->detach();
        $project->delete();

        if ($img_path && Storage::exists($img_path)) {
            Storage::delete($img_path);
        }

        return redirect()->route('guest.index');
    }

    // Elimina l'immagine di un progetto ma mantieni il record nel database
    public function deleteImg($id) {
        $project = Project::find($id);
        $img_path = $project->main_picture;

        // Elimina fisicamente l'immagine
        if ($img_path ) {
            Storage::delete($img_path);
        }

        $project->main_picture = null;
        $project->save();

        return back();
    }

    // Resto del codice delle funzioni per i tipi di progetti e le tecnologie...

    // Mostra l'elenco dei tipi di progetti
    public function typeIndex() {
        $types = Type::all();
        return view('logged.type.type-index', compact('types'));
    }

    // Mostra il form per creare un nuovo tipo di progetto
    public function typeCreate() {
        $projects = Project::all();
        return view('logged.type.type-create', compact('projects'));
    }

    // Salva il nuovo tipo di progetto nel database
    public function typeStore(Request $request){
        $data = $request->all();
        $type = Type::create($data);
        $projects = Project::all();
        // Assegna il nuovo tipo ai progetti desiderati
        foreach ($projects as $project) {
            if (in_array($project->id, $data['projects'])) {
                $project->type_id = $type->id;
                $project->save();
            }
        }
        return redirect()->route('logged.typeShow', $type->id);
    }

    // Mostra il form per modificare un tipo di progetto esistente
    public function typeEdit($id){
        $type = Type::find($id);
        $projects = Project::all();
        return view('logged.type.type-edit', compact('type', 'projects'));
    }

    // Aggiorna i dati di un tipo di progetto nel database
    public function typeUpdate(Request $request, $id){
        $data = $request->all();
        $type = Type::find($id);
        $type->update($data);
        return redirect()->route('logged.typeShow', $type->id);
    }

    // Mostra un singolo tipo di progetto
    public function typeShow($id) {
        $types = Type::all();
        $type = Type::find($id);
        return view('logged.type.type-show', compact('type', 'types'));
    }

    // Elimina un tipo di progetto dal database
    public function typeDelete(Request $request, $id) {
        $data = $request->all();
        $type = Type::find($id);
        $projects = Project::all();
        // Assegna un nuovo tipo ai progetti che utilizzano il tipo corrente
        foreach ($projects as $project) {
            if ($project->type_id == $type->id) {
                $project->type_id = $data["type_id"];
                $project->save();
            }
        }
        $type->delete();
        return redirect()->route('logged.typeIndex');
    }

    // Resto del codice per la gestione delle tecnologie...

    // Mostra l'elenco delle tecnologie
    public function technologyIndex() {
        $technologies = Technology::all();
        return view('logged.technology.technology-index', compact('technologies'));
    }

    // Mostra il form per creare una nuova tecnologia
    public function technologyCreate() {
        $projects = Project::all();
        return view('logged.technology.technology-create', compact('projects'));
    }

    // Salva la nuova tecnologia nel database
    public function technologyStore(Request $request){
        $data = $request->all();
        $technology = Technology::create($data);
        $technology->projects()->attach($data['projects']);
        return redirect()->route('logged.technologyShow', $technology->id);
    }

    // Mostra il form per modificare una tecnologia esistente
    public function technologyEdit($id){
        $technology = Technology::find($id);
        $projects = Project::all();
        return view('logged.technology.technology-edit', compact('technology', 'projects'));
    }

    // Aggiorna i dati di una tecnologia nel database
    public function technologyUpdate(Request $request, $id){
        $data = $request->all();
        $technology = Technology::find($id);
        $technology->update($data);

        // Se sono stati selezionati dei progetti, sincronizza le relazioni
        if (array_key_exists('projects', $data)) {
            $technology->projects()->sync($data['projects']);
        } else {
            // Altrimenti, rimuovi tutte le relazioni con i progetti
            $technology->projects()->detach();
        }

        return redirect()->route('logged.technologyShow', $technology->id);
    }

    // Mostra una singola tecnologia
    public function technologyShow($id) {
        $technology = Technology::find($id);
        return view('logged.technology.technology-show', compact('technology'));
    }

    // Elimina una tecnologia dal database
    public function technologyDelete($id) {
        $technology = Technology::find($id);

        // Rimuovi tutte le relazioni con i progetti prima di eliminare la tecnologia
        $technology->projects()->detach();
        $technology->delete();

        return redirect()->route('logged.technologyIndex');
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

