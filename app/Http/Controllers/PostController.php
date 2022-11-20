<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direst post list page
    public function index(){
        $categories = Category::get();
        $posts = Post::get();
        return view('admin.post.index',compact('categories','posts'));
    }

    //create post
    public function create (Request $request)
    {
        $validator = $this->checkPostValidation($request);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        if(!empty($request->postImage))
        {
            $file = $request->file('postImage');
            $fileName = uniqid().'_'.$file->getClientOriginalName();

            $file->move(public_path().'/postImage',$fileName);

            $data = $this->getPostData($request,$fileName);
        }
        else
        {
            $data = $this->getPostData($request,NULL);
        }

        Post::create($data);
        return back();
    }

    //delete post
    public function delete($id)
    {
        $postData = Post::where('post_id',$id)->first();
        $dbImageName = $postData['image'];

        Post::where('post_id',$id)->delete();

        if (File::exists(public_path().'/postImage/'.$dbImageName))
        {
            File::delete(public_path().'/postImage/'.$dbImageName);
        }

        return back();
    }

    //direct update post page
    public function updatePage ($id)
    {
        $postDetails = Post::where('post_id',$id)->first();
        $categories = Category::get();
        $posts = Post::get();
        return view('admin.post.edit',compact('postDetails','categories','posts'));
    }

    //update post
    public function update($id, Request $request)
    {
        $validator = $this->checkPostValidation($request);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $data = $this->requestUpdatePostData($request);

        if (isset($request->postImage))
        {
            $this->storeNewUpdateImage($request, $id, $data);
        } else
        {
            Post::where('post_id',$id)->update($data);
        }

        return back();
    }

    //get post data
    private function getPostData($request,$fileName)
    {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'image' => $fileName,
            'category_id' => $request->postCategory,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    //post validation check
    private function checkPostValidation($request)
    {
        return Validator::make($request->all(),[
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postCategory' => 'required'
        ]);
    }

    //request update post data
    private function requestUpdatePostData($request)
    {
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
            'category_id' => $request->postCategory,
            'updated_at' => Carbon::now()
        ];
    }

    //store new image
    public function storeNewUpdateImage ($request, $id, $data)
    {
        //get from client
        $file = $request->file('postImage');
        $fileName = uniqid().'_'.$file->getClientOriginalName();

        $data['image'] = $fileName;

        //get img name from database
        $postData = Post::where('post_id',$id)->first();
        $dbImageName = $postData['image'];

        //delete image form public folder
        if (File::exists(public_path().'/postImage/'.$dbImageName))
        {
            File::delete(public_path().'/postImage/'.$dbImageName);
        }

        //store new image to public folder
        $file->move(public_path().'/postImage',$fileName);

        Post::where('post_id',$id)->update($data);
    }
}
