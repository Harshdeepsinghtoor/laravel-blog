@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/category" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Edit Category</h1>
                    <p>Edit and submit this form to update a Category</p>

                    <hr>

                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="title">Category Names</label>
                                <input type="text" id="catname" class="form-control" name="catname"
                                       placeholder="Enter the Category Name Heres" value="{{ $category->catname }}" required>
                            </div>
                            
                                

                            
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary">
                                    Update Category
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection