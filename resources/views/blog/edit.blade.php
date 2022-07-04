@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/blog" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Edit Post</h1>
                    <p>Edit and submit this form to update a post</p>

                    <hr>

                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="title">Post Title</label>
                                <input type="text" id="title" class="form-control" name="title"
                                       placeholder="Enter Post Title" value="{{ $post->title }}" required>
                            </div>

                            <div class="control-group col-12">
                                <label for="catname">Select a category</label>
                                <select name="catname" class="form-control" id="catname" style="background-color: white;" >
                                    <option value="none" selected disabled hidden>Select an Category</option>
                                    @forelse ($cats as $cat)
                                        <option value="{{ $cat->id }}" @if ($post->catname==$cat->id)
                                            selected="true"
                                        @endif>{{ $cat->catname }}</option> 

                                    @empty
                                        No Categories Foundss
                                    @endforelse

                                </select>

                            </div>
                            {{-- Hiding body in editing field --}}
                            {{-- <div class="control-group col-12 mt-2">
                                <label for="body">Post Body</label>
                                <textarea id="body" class="form-control" name="body" placeholder="Enter Post Body"
                                          rows="5" required>{{ $post->body }}</textarea>
                            </div> --}}
                            {{-- Hiding is endings --}}
                            
                            {{-- Adding CKeditor for the instead of body fields --}}
                            <div class="control-group col-12 mt-2">
                                {{-- <form action="{{ url('ROUTE_HERE') }}" method="post"> --}}
                                    <textarea class="form-control" id="editor" name="editor">{!! $post->body !!}</textarea>
                                    {{-- {{ csrf_field() }}
                                    <input type="submit" name="submit" value="Submit" /> --}}
                                {{-- </form> --}}
                            </div>
                                <br>
                                <script>
                                    ClassicEditor
                                        .create( document.querySelector( '#editor' ) )
                                        .catch( error => {
                                            console.error( error );
                                        } );
                                    </script>

                            {{-- CKeditors endings Heres --}}

                            <div class="control-group col-12 mt-2">
                                <label for="body">Do you want to Publish ?</label><br>
                                <label for="publish">Yes</label>
                                <input type="radio" name="publish" value="1" @php echo($post->publish == '1' ? 'checked': ''); @endphp>
                                <label for="publish">NO</label>
                                <input type="radio" name="publish" value="0" @php echo($post->publish == '0' ? 'checked': ''); @endphp>
                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary">
                                    Update Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection