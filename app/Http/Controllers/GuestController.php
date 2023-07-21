<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;

class GuestController extends Controller
{
    public function index() {

        $projects = Project :: all();

        return view("guest.index", compact('projects'));
    }
    public function message() {

        return view("guest.message");
    }
}
