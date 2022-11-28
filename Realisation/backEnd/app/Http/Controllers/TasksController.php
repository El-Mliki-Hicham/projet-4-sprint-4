<?php

namespace App\Http\Controllers;

use App\Models\Briefs;
use App\Models\tasks;
use Egulias\EmailValidator\Warning\TLD;
use Illuminate\Http\Request;

class TasksController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $id = $request->brief_id;
        $task = Tasks::all();

        return $task;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $id = $request->brief_id;

        return view("task.create",compact("id"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Tasks();
        $task->Nom_de_la_tâche = $request->task;
        $task->Début_de_la_tâche= $request->date_debut;
        $task->Fin_de_la_tâche= $request->date_fin ;
        $task->briefs_id= $request->id_brief ;
        $task->save();
        return redirect('brief/'.$request->id_brief.'/edit' );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Tasks::find($id);
        $brief_id = $task->briefs_id;


        return view("task.edit",compact("task","brief_id"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,$id)
    {

        $task =Tasks::find($id);
        $task->Nom_de_la_tâche = $request->task;
        $task->Début_de_la_tâche= $request->date_debut;
        $task->Fin_de_la_tâche= $request->date_fin ;
        $task->save();
        return redirect('brief/'.$request->brief_id.'/edit' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request ,$id )
    {
       $brief_id= $request->brief_id;
        Tasks::find($id)
        ->delete();

        return redirect('brief/'.$brief_id.'/edit' );
    }
}
