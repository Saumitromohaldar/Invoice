<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Validator;
use Response;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories']=Category::paginate(10);
        return view('backend.categories.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            $response = array(
                'status' => 'fail',
                'errors'=>$validator->errors(),
            );
            return Response::json($response);
        }

        $category             = new Category;
        $category->name       = $request->name;
        $category->type       = $request->type;
        $category->save();

        if($category){
            $response = array(
                'status' => 'success',
                'message' => 'Category added successfully.',
            );
            return Response::json($response);
        }else{
            $response = array(
                'status' => 'fail',
                'message' => 'Something wrong please try again!',
            );
            return Response::json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
       // $company = \App\Company::where('id',$company_id)->first();
        $data['category']=$category;
        return view('backend.categories.edit-category',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            $response = array(
                'status' => 'fail',
                'errors'=>$validator->errors(),
            );
            return Response::json($response);
        }

        //$category             = new Category;
        $category->name       = $request->name;
        $category->type       = $request->type;
        $category->save();

        if($category){
            $response = array(
                'status' => 'success',
                'message' => 'Category updated successfully.',
            );
            return Response::json($response);
        }else{
            $response = array(
                'status' => 'fail',
                'message' => 'Something wrong please try again!',
            );
            return Response::json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        $response = array(
            'status' => 'success',
            'message' => 'Category deleted successfully.',
        );
        return Response::json($response);
       // return redirect()->back()->with('message', 'Category deleted successfully.');
    }
}
