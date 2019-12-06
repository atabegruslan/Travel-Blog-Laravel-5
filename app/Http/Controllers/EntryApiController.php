<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;

class EntryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $response = Entry::with('user')->get();
            $statusCode = 200;
        }catch(Exception $e){
            $response = [
                "error" => "Error"
            ];
            $statusCode = 404;
        }finally{
            return \Response::json($response, $statusCode); 
        }
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
        try{
            $initial_image_name = $request->file('image');
            $final_image_name = rand(10000,99999).time().'.'.$initial_image_name->getClientOriginalExtension();
            $final_image_path = IMG_DIR;

            $initial_image_name->move($final_image_path, $final_image_name);

            $entry = new Entry;
            $entry->place = $request->input('place');
            $entry->comments = $request->input('comments');
            $entry->user_id = $request->input('user_id');
            $entry->img_url = PUB_URL.'images/'.$final_image_name;
            $entry->save();

            $gcmResult = app('App\Http\Controllers\GcmController')->sendGcm($entry->place);

            $response = [
                "msg" => "OK"
            ];
            $statusCode = 200;
        }catch(Exception $e){
            $response = [
                "error" => "Error"
            ];
            $statusCode = 404;
        }finally{
            return \Response::json($response, $statusCode); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function gcmTest(){
    //     $gcmResult = app('App\Http\Controllers\GcmController')->sendGcm('GCM Test');
    //     return $gcmResult;
    // }
}
