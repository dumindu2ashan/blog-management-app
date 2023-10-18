<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Interfaces\BlogInterface;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(BlogInterface $blog)
    {
        $this->blog = $blog;
    }

    public function index()
    {
        $blogs = $this->blog->getAll();
        return view('blog/index', compact('blogs'));
    }

    public function save()
    {
        return view('blog/create');
    }

    public function insert(BlogStoreRequest $request)
    {
        $data = $this->blog->store($request);
        if ($data['code'] == 1) {
            return redirect('blogs')->with(['success' => true,
                'success' => 'Blog created Successfully!']);
        } else {
            return redirect('blogs')->withErrors($data['msg']);
        }
    }

    public function update($id)
    {
        $blog = $this->blog->findById($id);
        return view('blog/update', compact('blog'));
    }

    public function edit(BlogUpdateRequest $request)
    {
        $data = $this->blog->update($request->id, $request);
        if ($data['code'] == 1) {
            return redirect('blogs')->with(['success' => true,
                'success' => 'Blog Updated Successfully!']);
        } else {
            return redirect('blogs')->withErrors($data['msg']);
        }
    }

    public function delete(Request $request)
    {
        $data = $this->blog->delete($request->id);
        if ($data['code'] == 1) {
            return redirect('blogs')->with(['success' => true,
                'success' => 'Blog Deleted Successfully!']);
        } else {
            return redirect('blogs')->withErrors($data['msg']);
        }
    }
}
