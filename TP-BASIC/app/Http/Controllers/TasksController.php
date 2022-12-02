<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{

    public function index()
    {
        $tasks =Tasks::select("*",DB::raw("TIMESTAMPDIFF(HOUR,Date_debut,Date_fin) AS Period"))->get();
        // $tasks = Tasks::all();
        return  $tasks;
    }


    public function store(Request $request)
    {
        $tasks= new Tasks();
        $tasks->Task=$request->Task;

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
    public function show($id)
    {
        $tasks =Tasks::find($id);
        return  $tasks;
    }


    public function update(Request $request, $id)
    {

        $tasks= Tasks::find($id);
        $tasks->Task=$request->Task;
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
