<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;

class LoggedController extends Controller
{
    public function show($id) {

        $project = Project :: find($id);
        return view('logged.show', compact('project'));
    }
}
