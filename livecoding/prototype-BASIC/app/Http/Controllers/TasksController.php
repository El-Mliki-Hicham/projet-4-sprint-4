<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Tasks = Tasks::select('*',DB::raw("TIMESTAMPDIFF(HOUR,Date_debut,Date_fin) AS Period"))->get();
        return $Tasks ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $task->Task = $request->Task ;
        $task->Date_debut = $request->Date_debut ;
        $task->Date_fin = $request->Date_fin ;
        if($task->save()){
            return ['seccess'];

        }else{
            return ['erur'];
        };



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $tasks)
    {
        $Tasks = Tasks::find($tasks->id);
        return $Tasks;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Tasks = Tasks::find($id);
        return $Tasks;
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
        $task = Tasks::find($id);
        $task->Task = $request->Task ;
        $task->Date_debut = $request->Date_debut ;
        $task->Date_fin = $request->Date_fin ;
        if($task->save()){
            return ['seccess'];

        }else{
            return ['erur'];
        };

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $task = Tasks::find($id)->delete();

    }
}
