@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/blog" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Create a New Post</h1>
                    <p>Fill and submit this form to create a post</p>

                    <hr>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="title">Post Title</label>
                                <input type="text" id="title" class="form-control" name="title"
                                    placeholder="Enter Post Title" value="{{ old('title') }}"
                                    style="background-color: white">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="control-group col-12">
                                <label for="catname">Select a category</label>
                                <select name="catname" class="form-control" id="catname" style="background-color: white;" >
                                    <option value="none" selected disabled hidden>Select an Category</option>
                                    @forelse ($cats as $cat)
                                        <option value="{{ $cat->id }}" @if (old('catname')==$cat->id)
                                            selected="true"
                                        @endif>{{ $cat->catname }}</option>      

                                    @empty
                                        No Categories Foundss
                                    @endforelse

                                </select>




                                @error('catname')
                                    <span class="text-danger">{{ $message }}</span><br>
                                @enderror
                                <a href="/category" style="text-decoration: none;">Add or remove Categories</a>

                            </div>
                            {{-- Body is starting from heres --}}
                            {{-- <div class="control-group col-12 mt-2">
                                <label for="body">Post Body</label>
                                <textarea id="body" class="form-control" name="body" placeholder="Enter Posts Body" rows="">{{ old('body') }}</textarea>
                                @error('body')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                            </div> --}}
                            {{-- Body is endings in heres --}}

                            {{-- Ck editor instead of body --}}
                            <div class="control-group col-12 mt-2">
                                {{-- <form action="{{ url('ROUTE_HERE') }}" method="post"> --}}
                                <textarea class="form-control" id="editor" name="editor">{!! old('editor') !!}</textarea>
                                @error('editor')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- {{ csrf_field() }}
                                <input type="submit" name="submit" value="Submit" /> --}}
                                {{-- </form> --}}
                            </div>
                            <br>
                            <script>
                                ClassicEditor
                                    .create(document.querySelector('#editor'))
                                    .catch(error => {
                                        console.error(error);
                                    });
                            </script>
                            {{-- Ending Heres --}}

                            <div class="control-group col-12">
                                <label for="photo">Upload a photo</label>
                                <input type="file" id="photo" class="form-control" name="photo" accept="image/*"
                                    style="background-color: white">
                                @error('photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Here i am adding a button for the Publish Options --}}
                            <div class="control-group col-12 mt-2">
                                <label for="body">Do you want to Publish now ?</label><br>
                                <label for="publish">Yes</label>
                                <input type="radio" name="publish" value="1"
                                    @if (old('publish') == 1) {{ 'checked' }} @endif>
                                <label for="publish">No</label>
                                <input type="radio" name="publish" value="0"
                                    @if (old('publish') == 0) {{ 'checked' }} @endif><br>
                                @error('publish')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Publish Ending Heres --}}
                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary">
                                    Create Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
