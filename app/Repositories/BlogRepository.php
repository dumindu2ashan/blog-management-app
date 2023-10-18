<?php


namespace App\Repositories;


use App\Interfaces\BlogInterface;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogRepository implements BlogInterface
{

    public function getAll()
    {
        return Blog::where('user_id', Auth::id())->get();
    }

    public function getPagination(){
        return Blog::orderBy('published_date','desc')->paginate(10);
    }

    public function store($data)
    {
        try {
            $blog = new Blog();
            $blog->user_id = Auth::id();
            $blog->title = $data->title;
            $blog->content = $data->content;
            $blog->published_date = $data->published_date;
            $blog->save();

            $response['code'] = 1;
            $response['msg'] = "Success";
            return $response;
        } catch (\Exception $e) {
            $response['code'] = 0;
            $response['msg'] = $e->getMessage();
            return $response;
        }
    }

    public function findById($id)
    {
        return Blog::findOrFail($id);
    }

    public function update($id, $data)
    {
        try {
            $blog = Blog::findOrFail($id);

            if($blog->user_id!=Auth::id()){
                $response['code'] = 0;
                $response['msg'] = 'Permission Denied.';
                return $response;
            }

            $blog->title = $data->title;
            $blog->content = $data->content;
            $blog->published_date = $data->published_date;
            $blog->update();

            $response['code'] = 1;
            $response['msg'] = "Success";
            return $response;
        }catch (\Exception $e){
            $response['code'] = 0;
            $response['msg'] = $e->getMessage();
            return $response;
        }
    }

    public function delete($id)
    {
        try {
            $blog = Blog::findOrFail($id);
            if($blog->user_id!=Auth::id()){
                $response['code'] = 0;
                $response['msg'] = 'Permission Denied.';
                return $response;
            }
            $blog->delete();

            $response['code'] = 1;
            $response['msg'] = "Success";
            return $response;
        }catch(\Exception $e){
            $response['code'] = 0;
            $response['msg'] = $e->getMessage();
            return $response;
        }
    }
}
