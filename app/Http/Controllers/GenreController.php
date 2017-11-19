<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index( $id = null)
    {
        if($id == null ){
            return Genre::orderby('genre_id', 'asc')->get();
        }else{
            return Genre::find($id);
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
        

        $vMsgs = [];

        $genre =  new Genre;

        $genre->name = $request->input('name');
        $genre->desc = $request->input('desc');

        $v = Validator::make($request->all(), [
            'name' => 'required|max:45'
        ]);



        if ($v->fails()){
            $vMsgs = [ 'error' => $v->errors()->all(),
                'success' => 0];
        }else{
            $genre->save();
            $vMsgs = [ 'error' => 0,
                'success' => 'Saved successfuly',
                'genre_id' => $genre->genre_id];
        }

        return response()->json($vMsgs);

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
        $vMsgs = [];

        $genre = Genre::find($id);

        $genre->name = $request->input('name');
        $genre->desc = $request->input('desc');


        $v = Validator::make($request->all(), [
            'name' => 'required|max:45'
        ]);

        if ($v->fails()){
            $vMsgs = [ 'error' => $v->errors()->all(),
                'success' => 0];
        }else{
            $genre->save();
            $vMsgs = [ 'error' => 0,
                'success' => 'Successfully Updated.'];
        }

        return response()->json($vMsgs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vMsgs = [];

        $genre = Genre::find($id);
        $genre->delete();


        return response()->json($vMsgs = [ 'error' => 0,
            'success' => 'Successfully Deleted.']);
    }
}
