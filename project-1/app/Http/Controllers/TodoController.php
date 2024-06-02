<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index(){
        $todo = DB::table('todo_items')->where('status','<>','completed')->select('title','item_id')->get();
        $complete_tod = DB::table('todo_items')->where('status','completed')->select('item_id','title')->get();
        return view('welcome',['todo'=>$todo,'complete_todo'=>$complete_tod]);
    }
    public function add_todo(Request $request){
        $title = $request->todo_title;
        DB::table('todo_items')->insert([
            'title'=>$title
        ]);
        return redirect()->back()->with('success', 'Todo item created successfully');
    }
    public function completed(Request $request){
       $id = $request->todo_id;
       DB::table('todo_items')->where('item_id',$id)->update([
        'status' =>'Completed'
       ]);
       return response()->json(['status'=>'Task Completed']);
    }
    public function delete(Request $request){
        $todo_id = $request->todo_id;
        $result = DB::table('todo_items')->where('item_id',$todo_id)->delete();
        return response()->json(['message'=>'success']);
    }
}
