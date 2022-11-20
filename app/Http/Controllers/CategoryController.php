<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function index()
    {
        $categories = Category::get();
        return view('admin.category.index',compact('categories'));
    }

    //create new category
    public function create(Request $request)
    {
        $validator = $this->categoryValidationCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
            'created_at' => Carbon::now()
        ];

        Category::create($data);
        return back();

    }

    //delete category
    public function delete($id)
    {
        Category::where('category_id',$id)->delete();
        return redirect()->route('admin#category');
    }

    //category search
    public function search(Request $request)
    {
        $categories = Category::where('title','LIKE','%'.$request->categorySearchKey.'%')->get();
        return view('admin.category.index', compact('categories'));
    }

    //category edit page
    public function editPage ($id)
    {
        $categories = Category::get();
        $data = Category::where('category_id',$id)->first();

        return view('admin.category.edit',compact('data', 'categories'));
    }

    //category update
    public function update($id, Request $request)
    {
        $validator = $this->categoryValidationCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $updateData = [
            'title' => $request->categoryName,
            'description' => $request->categoryDescription,
            'updated_at' => Carbon::now()
        ];

        Category::where('category_id',$id)->update($updateData);
        return redirect()->route('admin#category');
    }

    //category validation check
    private function categoryValidationCheck($request)
    {
        return Validator::make($request->all(), [
            'categoryName' => 'required',
            'categoryDescription' => 'required',
        ],[
            'categoryName.required' => 'Name is required',
            'categoryDescription.required' => 'Description is required'
        ]);
    }
}
