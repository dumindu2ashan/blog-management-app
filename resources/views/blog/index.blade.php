@extends('layouts.app')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">{{$error}}</div>
            @endforeach
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row">
            <div class="col-md-8 offset-md-0">
                <a href="{{url('blogs/save')}}" class="btn btn-primary">Create Blog</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Blog Management</div>

                    <div class="card-body">

                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Publish Date</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <td>{{$blog->title}}</td>
                                    <td>{{$blog->published_date}}</td>
                                    <td>
                                        <a href="{{url('blogs/update').'/'.$blog->id}}" class="btn btn-primary">
                                            Edit
                                        </a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{url('blogs/delete')}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$blog->id}}">
                                            <button type="submit" onclick="return confirm('Sure want ro delete?')"
                                                    id="delete-btn" class="btn btn-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        new DataTable('#example');
    </script>
@endsection
