<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $tests=Test::all();
        return view('test.index');
    }
    public function test()
    {
        // $tests=Test::all();
        return view('test.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show_test()
    {
        $tests=Test::all();

        return response()->json([
            'tests'=>$tests,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $validate = Validator::make($request->all(), [
            'name'=>'required|string',
            'description'=>'string',
            'price'=>'integer'
        ]);
        if($validate->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validate->messages()
            ]);
        }else{
            $test=Test::create($data);
                if($request->hasFile('image')){
                    $test->addMediaFromRequest('image')->toMediaCollection('test_image');
                }
            return response()->json([
                'message'=>'Test Added '
            ]);
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data=$request->all();
        $validate = Validator::make($request->all(), [
            'name'=>'required|string',
            'description'=>'string',
            'price'=>'integer'
        ]);
        if($validate->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validate->message()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $test=Test::find($id);
        if($test){
            return response()->json([
                'test'=>$test,
                'status'=>200
            ]);
        }else{
            return response()->json([
                'message'=>'not found',
                'status'=>400
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $data=$request->all();
        $validatedData=$request->validate([
            'name'=>'required|string',
            'description'=>'string',
            'price'=>'integer'
        ]);
        $test=Test::find($id);
        if($test){
            $test->update($data);
            return response()->json([
                'message'=>'Update success',
            ]);
        }else{
            return response()->json([
                'status'=>400,
                'message'=>'Id Not Found'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $test=Test::find($id);
        if($test){
            $test->delete();
            return response()->json([
                'message'=>'Test Delete successfully'
            ]);
        }else{
            return response()->json([
                'message'=>'Id Not Found',
                'status'=>400
            ]);
        }
    }
}
