@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border:2px solid black;padding:10px;background-color:pink;border-radius:10px ">
               
               <h1 style="color:green">Blogs Page</h1>
               <div>
                   <form action="fkasjfkj" method="post">
                       <label for="name" style="color:green">Blog Name</label><br>
                       <input type="text" name="name" style="border:1px solid blue;border-radius:10px;"><br>
                       <label for="content" style="color:green">Content</label><br>
                        <textarea name="content" cols="30" rows="10" style="border:1px solid blue;border-radius:10px;"></textarea><br><br>
                        <input type="submit" value="Save" name="saves" style="background-color:black;color:white;padding:7px;width:150px;font-weight:bolder;border-radius:10px ">
                   </form>
               </div>
             
            </div>
        </div>
    </div>
</div>
@endsection
