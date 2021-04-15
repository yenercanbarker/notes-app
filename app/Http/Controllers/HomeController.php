<?php

namespace App\Http\Controllers;

use App\Models\ToDoList;
use Illuminate\Support\Facades\Auth;

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
        if(!Auth::user()) {
            return view('home');
        }
        return $this->to_do_lists();
    }

    public function to_do_lists() {
        $lists = ToDoList::allLists();
        return view('lists')->with(['toDoList' => $lists]);
    }

}
