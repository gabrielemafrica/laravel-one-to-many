<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Type;

class LoggedController extends Controller
{
    public function show($id) {

        $project = Project :: find($id);
        return view('logged.show', compact('project'));
    }
    public function create() {
        $types = Type :: all();
        return view('logged.create', compact('types'));
    }

    public function store(Request $request){
        $data = $request -> all();
        $project = Project :: create($data);
        return redirect() -> route('logged.show', $project -> id);
    }
    public function edit($id){

        $project = Project :: find($id);
        $types = Type :: all();

        return view('logged.edit', compact('project', 'types'));
    }
    public function update(Request $request, $id){

        $data = $request -> all();

        $project = Project :: find($id);
        $project -> update($data);

        return redirect() -> route('guest.index');
    }
}
