<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Goal $goal)
    {
         $todos = $goal->todos()->orderBy('done', 'asc')->orderBy('position', 'asc')->get();
         return response()->json($todos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Goal $goal)
    {
         $todo = new Todo();
         $todo->content = request('content');
         $todo->user_id = Auth::id();
         $todo->goal_id = $goal->id;
         $todo->position = request('position');
         $todo->done = false;
         $todo->save();
         $todos = $goal->todos()->orderBy('done', 'asc')->orderBy('position', 'asc')->get();
         return response()->json($todos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal, Todo $todo)
    {
          $todo->content = request('content');
         $todo->user_id = Auth::id();
         $todo->goal_id = $goal->id;
         $todo->position = request('position');
         $todo->done = (bool) request('done');
         $todo->save();
 
         $todos = $goal->todos()->orderBy('done', 'asc')->orderBy('position', 'asc')->get();
         return response()->json($todos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Goal $goal,Todo $todo)
    {
         $todo->delete();
         $todos = $goal->todos()->orderBy('done', 'asc')->orderBy('position', 'asc')->get();
         return response()->json($todos);
    }
}
