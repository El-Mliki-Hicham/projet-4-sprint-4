<?php

namespace App\Http\Controllers;

use App\Models\assigner;
use App\Models\Briefs;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Http\Request;

class PromotionController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotion = Promotion::all();
        return $promotion;
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
        $promotion = New Promotion();
        $promotion->Name_promotion =$request->Name_promotion;
        $promotion->save();
        if ($promotion) {
            return 'data has been add';
        }{
            return 'erurr';

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        $id = $promotion->id;
        $promotion = Promotion::find($promotion->id);
        $student =$promotion->Student;

        // return promotion","student","id";

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {

      $promotion=  Promotion::find($promotion->id)
        ->update([
            'Name_promotion'=>$request->Name
        ]);
        return back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        Promotion::find($promotion->id)->delete();
        return back();
    }
}
