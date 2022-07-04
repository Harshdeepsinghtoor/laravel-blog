@extends('layouts.app')

@section('content')
    <div style="font-family: 'Poppins', sans-serif">
        <div style="background-color: rgb(248, 248, 255);" class="py-5">
            <div class="container">
                <div class="row flex-column-reverse flex-md-row">
                    <div class="col-12 col-md-5 d-flex align-items-center">
                        <div class="bd-info">
                            <div class="mb-2">
                                <a class="categories-tag"
                                    href="/front/category/{{ $posts->category->catslug }}">{{ $posts->category->catname }}</a>
                            </div>
                            <h1>{{ $posts->title }}</h1>
                            <div class="blog_heading_footer">
                                <div style="border-right: 1px solid #e4e9ee;padding: 10px;">{{ $posts->created_at }}
                                </div>
                                <div style="padding: 10px;">{{ $posts->user->name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <div class="bl-featured-img">

                            <img src="{{ URL::asset('images/' . $posts->photo) }}" alt="Feature Imagess"
                                style="height:400px;width:650px;">
                            {{-- style="height:450px;width:700px;" --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container pb-5 my-lg-5">
            <div class="row flex-row flex-sm-row">

                <div class="col-12 col-lg-2">
                    <div class="share_container">
                        <h3 class="share-on"> SHARE ON:</h3>
                        <ul style="margin: 0;padding: 0;list-style: none;">
                            <li class="share-blog my-3"><button aria-label="facebook" class="react-share__ShareButton"
                                    style="background-color: transparent; border: none; padding: 0px; font: inherit; color: inherit; cursor: pointer;"><i
                                        class="fa fa-facebook-square mr-2" aria-hidden="true"></i>Facebook</button></li>
                            <li class="share-blog my-3"><button aria-label="twitter" class="react-share__ShareButton"
                                    style="background-color: transparent; border: none; padding: 0px; font: inherit; color: inherit; cursor: pointer;"><i
                                        class="fa fa-twitter mr-2" aria-hidden="true"></i>Twitter</button></li>
                            <li class="share-blog my-3"><button aria-label="linkedin" class="react-share__ShareButton"
                                    style="background-color: transparent; border: none; padding: 0px; font: inherit; color: inherit; cursor: pointer;"><i
                                        class="fa fa-linkedin-square mr-2" aria-hidden="true"></i>LinkedIn</button></li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <article>
                        <div class="detail-wrap">
                            {{-- Lefting Author Metas --}}
                            <div class="detail-content" style="font-size:1.2rem;">

                                <p>{!! $posts->body !!}</p>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-12 col-lg-2 text-center" style="text-align: center;">
                    <a class="likebutton" style="color:#01e08f;text-decoration:none;"><i class="fa fa-heart-o"
                            aria-hidden="true"></i><span class="counter" style="color:#013870;">1</span></a>
                </div>

            </div>
        </div>

    </div>
@endsection
