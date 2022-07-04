@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/category" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Create a New Category</h1>
                    <p>Fill and submit this form to create a Category</p>

                    <hr>

                    {{-- Errors Staring Heres --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- Errors Ending Heres --}}

                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="catname">Enter Category Name</label>
                                <input type="text" id="title" class="form-control" name="catname"
                                    placeholder="Enter Category Name" value="{{ old('catname') }}"style="background-color: white"   >
                                @error('catname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary">
                                    Create Category
                                </button>
                                
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
