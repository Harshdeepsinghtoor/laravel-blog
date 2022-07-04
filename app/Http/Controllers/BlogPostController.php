<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use \App\Http\Requests\StorePostRequest;
use App\Models\BlogCategory;
// use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = BlogPost::paginate(8); //fetch all blog posts from DB 
        return view('blog.index', [
            'pop' => $posts,
        ]); //returns the view with posts
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriestoshows = BlogCategory::all();
        return view('blog.create', ['cats' => $categoriestoshows,]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StorePostRequest $request)
    {
        //  $slugs=Str::slug($request->title);
        //  echo $slugs;
        //  die();
        $currentusers = Auth::user();

        $imageName = time() . '.' . $request->photo->extension();

        $request->photo->move(public_path('images'), $imageName);

        // Method 1
        // $validated = $request->validate([
        //     'title' => 'required|unique:blog_posts|max:255',
        //     'body' => 'required|min:10',

        // ]);
        // The blog post is valid...
        // Method 2
        $validated = $request->validated();


        $newPost = BlogPost::create([
            'title' => $request->title,
            'body' => $request->editor,
            'user_id' => $currentusers->id,
            'photo' => $imageName,
            'publish' => $request->publish,
            'catname' => $request->catname,

        ]);

        return redirect('blog/' . $newPost->slug)->with('create', 'Blog Created Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show($blogPost) //Here it is fetching the data from the model(Blogpost  ) where id(Which is auto increment id ) is equal to $blogpost
    {

        // BlogPost $blogPost
        $datas = BlogPost::select('*')
            ->where('slug', '=', $blogPost)
            ->first();

        // This is alternates methods of this function $blog = BlogPost::find($blogPost);

        // return $blogPost; //returns the fetched posts
        return view('blog.show', [
            'post' => $datas,
        ]); //returns the view with the post
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        //
        $categoriestoshows = BlogCategory::all();
        return view('blog.edit', [
            'post' => $blogPost, 'cats' => $categoriestoshows,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {

        // The blog post is valid...
        //

        $blogPost->update([
            'title' => $request->title,
            'body' => $request->editor,
            'catname' => $request->catname,
            'publish' => $request->publish,
        ]);

        return redirect('blog/' . $blogPost->slug)->with('message', 'Blog Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        //
        $blogPost->delete();

        return redirect('/blog')->with('deletemesg', 'Blog Deleted Successfully');
        echo "Blog delted successfully";
    }
    public function ajax(Request $request,)
    {
        $datas = BlogPost::select('publish')
            ->where('id', '=', $request->post_id)
            ->first();
        $publishvalue = $datas->publish;
        if ($publishvalue == 1) {
            $givingvalues = 0;
        } else {
            $givingvalues = 1;
        }
        BlogPost::where("id", $request->post_id)->update(["publish" => $givingvalues]);
        $result = array('status' => $givingvalues);
        echo json_encode($result);
        //if ($givingvalues==1) {
        //echo "Published Successfully !" ;
        // echo '<span style="border-radius:6px; color:white;font-weight:bolder;margin-left:40px;background-color:green;padding:5px;width:75px;display:inline-block;">Published</span>';
        //}else{
        //echo "Unpublished" ;
        // echo '<span style=" text-align:center;border-radius:6px;border:1px solid #dc3545;color:#dc3545;font-weight:bolder;margin-left:40px;background-color:white;padding:5px;width:75px;display:inline-block;">Unpublish</span>';
        // }
        // echo $request->post_id;
        die();
    }
    // public function example(){
    //     $posts = BlogPost::paginate(8); //fetch all blog posts from DB
    // return view('blog.example', [
    //     'pop' => $posts,
    // ]); //returns the view with posts
    // }

    public function front()
    {


        // $posts = BlogPost::select('blog_posts.title','blog_posts.body','blog_posts.created_at','blog_posts.photo','blog_posts.slug','blog_categories.catname','users.name')
        //       ->join('blog_categories', 'blog_categories.id', '=', 'blog_posts.catname')
        //       ->join('users', 'users.id', '=', 'blog_posts.user_id')
        //       ->paginate(5);
        // $users = BlogPost::join('blog_categories', 'blog_categories.id', '=', 'blog_posts.catname')
        //       ->join('users', 'users.post_id', '=', 'posts.id')
        //       ->get(['users.*', 'posts.descrption']);

        //     $post = BlogPost::with(['category' => function ($query) {
        //     $query->select('id', 'catname');
        // }])
        // ->get();


        $posts = BlogPost::with(['category:id,catname,catslug', 'user:id,name'])
            ->where('publish', '=', '1')
            ->orderBy('id', 'desc')
            ->paginate(5);
        $categories = BlogCategory::all();
        // echo $post->category->catname;
        // echo "<pre>";
        // echo $posts;
        // die;
        //         dd($post->user->name);

        // $posts = BlogPost::select('*')
        // ->where('publish', '=', true)
        // ->paginate(5);






        return view('front.front', ['posts' => $posts, 'categories' => $categories]);
    }

    public function frontshows($blogPost)
    {


        $datas = BlogPost::select('*')
            ->where('slug', '=', $blogPost)
            ->first();

        // echo "<pre>";
        // echo $datas;
        // die;
        // $withslash=$datas->body; 
        // echo $withslash ;     
        // die() ;            

        // $withoutslash=strip_tags($datas->body); 
        // $wordscounts= str_word_count($withoutslash);
        // $dividedrounds= round($wordscounts/100);
        // if ($dividedrounds==0) {
        //     $readingtimes=1;
        // }else{
        //     $readingtimes=$dividedrounds;
        // }


        // 'times'=>$readingtimes     




        return view('front.show', ['posts' => $datas,]);
    }
    // AJAX FOR FILTER THE BLOG 
    public function frontajax(Request $request)
    {
        $whereclauses = $request->category_id;

        if ($whereclauses == "most-recent") {
            $categoryviewsdata = BlogPost::select('*')
                ->where('publish', '=', true)
                ->orderBy('created_at', 'desc')
                ->paginate();
        } elseif ($whereclauses == "oldest") {


            $categoryviewsdata = BlogPost::select('*')
                ->where('publish', '=', true)
                ->paginate();
        } else {

            $categoryviewsdata = BlogPost::select('*')
                ->where('catname', '=', $whereclauses)
                ->where('publish', '=', true)
                ->orderBy('id', 'desc')
                ->paginate();
        }

        return view('front.Ajaxcategoriess', ['posts' => $categoryviewsdata]);
        // return($request->category_id); 

    }
    public function filtercategory($category)
    {
        // $datas = BlogPost::all();
        // echo $datas->category->catname;
        // die();


        $manyposts = BlogCategory::select('id', 'catname', 'catslug')
            ->where('catslug', '=', $category)
            ->first();

        // echo $manyposts;
        // die();


        // echo "<pre>";
        // print_r($posts);
        //  foreach ($manyposts as $post) {
        $posts = $manyposts->postsfromcategory()->paginate(5);
        //  }

        // echo "<pre>";
        // print_r($posts);
        // die();
        // foreach ($posts as $post) {
        //     echo "<pre>";
        //     print_r($post->user);
        // }


        $categories = BlogCategory::all();
        return view('front.front', ['posts' => $posts, 'categories' => $categories,]);
    }
}
