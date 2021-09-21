<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use DB;
use Illuminate\Support\Facades\Config;
class PostController extends Controller
{
    public function index(){
        Config::set('database.default', 'mysql');
        DB::reconnect('mysql');
        return Post::all();
    }

    public function store(Request $request){
        try{
            Config::set('database.default', 'mysql');
            DB::reconnect('mysql');
            $post = new Post();
            $post->title = $request->title;
            $post->body = $request->body;
            if($post->save()){
                return response()->json(['status'=>'success','message'=>'Post Created Successfully']);
            }
        }
        catch(Exception $e){
            return response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }

    public function update(Request $request,$id){
        try{
            Config::set('database.default', 'mysql');
            DB::reconnect('mysql');
            $post =Post::findOrFail($id);
            $post->title = $request->title;
            $post->body = $request->body;
            if($post->save()){
                return response()->json(['status'=>'success','message'=>'Post Updated Successfully']);
            }
        }
        catch(Exception $e){
            return response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }

    public function destory(Request $request,$id){
        try{
            Config::set('database.default', 'mysql');
            DB::reconnect('mysql');
            $post =Post::findOrFail($id);
            if($post->delete()){
                return response()->json(['status'=>'success','message'=>'Post Delete Successfully']);
            }
        }
        catch(Exception $e){
            return response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }
    public function dummytrymysql(){
        try{ 
            Config::set('database.default', 'mysql2');
            DB::reconnect('mysql2');
            $results = DB::select( DB::raw("SELECT * FROM engine4_onetime_events WHERE event_id=2") );
            return $results;
        }
        catch(Exception $e){
            return response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }
}
