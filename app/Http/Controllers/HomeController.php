<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function to_do_lists() {
        $lists = ToDoList::allLists();
        return view('lists')->with(['toDoList' => $lists]);
    }

}
