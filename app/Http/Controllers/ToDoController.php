<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('todo');
    }

    public function fetchAll(Request $request){
       // dd($request->all());


         if($request->status!=2){

            $records=  ToDo::where('status',$request->status)->orderBy('status')->orderBy('updated_at','DESC')->get();
        }else{

            $records=  ToDo::orderBy('status')->orderBy('updated_at','DESC')->get();
        }

        return $records;


    }

    public function updateStatus(Request $request){


    //ToDo::where('id',$request->id)->update(['status'=>1]);

    $todo = ToDo::find($request->id);

    if ($todo) {
        // Toggle the status value
        $todo->status = $todo->status == 1 ? 0 : 1;
        $todo->save();

        return ['message' => 'Status updated successfully'];
    } else {
        return response()->json(['message' => 'ToDo not found'], 404);
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
        /* dd($request->all()); */

        $this->validate(request(),[

            'title'=>'required',


                ]);

        $todo = new ToDo;

        $todo->title=$request->title;
        $todo->save();
        return ['message'=>'Added'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function show(ToDo $toDo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function edit(ToDo $toDo, $id)
    {
        $todo = ToDo::find($id);
        return $todo;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToDo $toDo)
    {

        $this->validate(request(),[

            'title'=>'required',


                ]);
             $toDo::where('id',$request->id)->update(['title'=>$request->title]);
             return ['message' => 'successfully updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ToDo  $toDo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToDo $toDo, $id)
    {

       // $toDo->forceDelete();
       // $toDo->delete();
      //return $toDo;
        ToDo::where('id',$id)->delete();

        return ['message '=>'record deleted'];
    }
}
