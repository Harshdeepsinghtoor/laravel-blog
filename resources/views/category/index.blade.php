@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="row">
                    <div class="col-8">
                        @if (Session::has('deletemesg'))
                            <p class="alert alert-danger">{{ Session::get('deletemesg') }}</p>
                        @endif
                        @if (Session::has('category'))
                            <p class="alert alert-success">{{ Session::get('category') }}</p>
                        @endif

                        @if (Session::has('message'))
                            <p class="alert alert-warning">{{ Session::get('message') }}</p>
                        @endif
                        <h1 class="display-one">Categories</h1>
                        <a href="/blog/create/post" class="btn btn-outline-primary btn-sm">Go back</a>                
                        {{-- <p>Enjoy reading our posts. Click on a post to read!
                        </p> --}}
                    </div>
                    <div class="col-4" style="border:2px dotted gray;border-radius:10px;text-align:center; ">
                        <p style="font-weight:bold;">Add New Category</p>
                        <a href="/blog/create/category" class="btn btn-primary btn-sm">Add Category</a>
                    </div>
                    {{-- <div class="col-2" style="border:2px dotted gray;border-radius:10px; ">
                        <p>Add a new Category</p>
                        <a href="/blog/create/category" class="btn btn-primary btn-sm">Add Category</a>
                    </div> --}}
                </div><hr>
                @forelse($cats as $cat)
                    <ul>
                        <li><a href="   " style="display:inline-block;width:170px;text-decoration:none;"><b>{{ ucfirst($cat->catname) }}</b></a> 
        
                            <a href="/category/{{ $cat->id }}/edit" class="btn btn-outline-primary"
                                style="margin-left: 50px">Edit</a>
                            <form id="delete-frm" class="" action="./category/{{ $cat->id }}" method="POST"
                                style="display:inline;margin-left:5px;">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" onclick="return confirm('Are you sure ?')">Delete</button>
                            </form>
                            {{-- This is prv location --}}

                            {{-- Prv Locations endings --}}

                        </li>
                        <hr>
                    </ul>
                @empty
                    <p class="text-danger">No Categories Found too shows</p> 
                @endforelse
            </div>
        </div>
    </div>
@endsection
