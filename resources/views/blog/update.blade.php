@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 offset-md-0">
                <a href="{{url('blogs')}}" class="btn btn-primary">Blogs list</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Update Blog</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('blogs/edit') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{$blog->id}}">
                            <div class="row mb-3">
                                <label for="title"
                                       class="col-md-4 col-form-label text-md-end">Title</label>
                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ old('title',$blog->title) }}" autocomplete="title" autofocus>
                                    @error('title')<span class="invalid-feedback"
                                                         role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="content"
                                       class="col-md-4 col-form-label text-md-end">Content</label>
                                <div class="col-md-6">
                                    <textarea type="form-control @error('content') is-invalid @enderror" name="content"
                                              id="myeditorinstance">{{old('content',$blog->content)}}</textarea>
                                    @error('content')<span class="invalid-feedback"
                                                           role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="published_date"
                                       class="col-md-4 col-form-label text-md-end">Published Date</label>
                                <div class="col-md-6">
                                    <input id="published_date" type="text"
                                           class="form-control @error('published_date') is-invalid @enderror"
                                           name="published_date"
                                           value="{{ old('published_date',$blog->published_date) }}" autofocus
                                           data-date-format="yyyy-mm-dd"
                                           autocomplete="off">
                                    @error('published_date')<span class="invalid-feedback"
                                                                  role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#published_date').datepicker({
            maxDate: 0,
            dateFormat: 'yy-mm-dd',
            setDate: new Date(),
        });

        tinymce.init({
            selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'powerpaste advcode table lists checklist',
            toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
        });
    </script>
@endsection

