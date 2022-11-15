<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks =Tasks::all();
        return  $tasks;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tasks= new Tasks();
        $tasks->Nom_de_la_tache=$request->Nom_de_la_tache;
        $tasks->briefs_id=5;
        $tasks->save();
        if($tasks->save()){
            return ['data has been add'];
        } {
            return ['erurr'];

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $tasks= Tasks::find($id);
        $tasks->Nom_de_la_tache=$request->Nom_de_la_tache;
        $tasks->save();
        if($tasks->save()){
            return ['data has been update'];
        } {
            return ['erurr'];

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasks= Tasks::find($id)->delete();
        if($tasks){
            return ['data has been deleted'];
        } {
            return ['erurr'];

        }
    }
}
