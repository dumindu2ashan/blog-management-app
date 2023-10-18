<?php

namespace App\Http\Controllers;

use App\Interfaces\BlogInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BlogInterface $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogs = $this->blog->getPagination();
        return view('welcome',compact('blogs'));
    }

    public function readBlog($id){
        $blog = $this->blog->findById($id);
        return view('read',compact('blog'));
    }
}
