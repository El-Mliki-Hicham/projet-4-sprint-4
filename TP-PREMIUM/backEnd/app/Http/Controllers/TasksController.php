<?php

namespace App\Http\Controllers;

use App\Models\Briefs;
use App\Models\tasks;
use Egulias\EmailValidator\Warning\TLD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
          $task =Tasks::select('*',DB::raw("TIMESTAMPDIFF(HOUR,Debut_de_la_tache,Fin_de_la_tache) AS Period"))->get();
        // $task = Tasks::all();

        return $task;
    }




    public function store(Request $request)
    {
        $task = new Tasks();
        $task->Nom_de_la_tache = $request->Nom_de_la_tache;
        $task->Debut_de_la_tache= $request->Debut_de_la_tache;
        $task->Fin_de_la_tache= $request->Fin_de_la_tache ;

        $task->save();


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

        return $task;
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
        $task->Nom_de_la_tache = $request->Nom_de_la_tache;
        $task->Debut_de_la_tache= $request->date_debut;
        $task->Fin_de_la_tache= $request->date_fin ;
        $task->save();

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


    }
}
