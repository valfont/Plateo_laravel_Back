<?php

namespace App\Http\Controllers;
use App\Models\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class ArtisanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Artisan = Artisan::all();
        return response()->json(['success'=>$Artisan,
                                 'result'=>'voici tous les Artisans']);
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
        Validator::make($request->all(), [
            'nameRS' => 'string|unique:artisans|required',
            'adresse' => 'string',
            'siren' => 'integer|digits_between:9,10',
            'email' => 'string|required',
            'tel' => 'integer',
            'comment' => 'string'
        ])->validate();
        
        $data = $request->all();
        $artisan = Artisan::create($data);
        
        return response()->json(['success'=> $artisan,
                                  'result'=>'New client added with success']);
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
        // $Artisan = Artisan::findorfail($id);
        // $Artisan->delete();
        // return response()->json(['success'=> $Artisan,
        //                           'result'=>'Artisan supprimé']);

    }
}
