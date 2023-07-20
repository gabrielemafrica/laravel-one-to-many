<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;

class MainController extends Controller
{
    public function index() {

        $projects = Project :: all();

        return view("index", compact('projects'));
    }
}
