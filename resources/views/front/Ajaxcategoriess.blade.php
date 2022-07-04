{{-- WHG --}}
{{-- <h1>Hello Ajax</h1> --}}
@forelse ($posts as $post)
    <div style="margin-bottom: 105px;display:flex;">
        <div class="photodiv">
            <a href="front/{{ $post->slug }}">
                <img class="img img-fluid"
                    @if (isset($post->photo)) src="{{ URL::asset('/images/' . $post->photo) }}"
      @else
  src="https://wemoter.webethics.online/public/blogs/62a172adf1ef27dbda02b682/20220654061854_20220509112609_DP-Pics-Images-Wallpaper-for-Whatsapp.jpg" @endif
                    alt="feature image" style="height:350px;width:550px; ">
            </a>
        </div>
        {{-- ;border:1px solid gray --}}
        <div class="contentsdiv" style="margin-left:100px;width:62%;padding:5px;position:relative;">
            <p style="float:left;">@php $times=strtotime($post->created_at) @endphp {{ date('F d,Y', $times) }}</p>

            @php
                $withoutslash = strip_tags($post->body);
                $wordscounts = str_word_count($withoutslash);
                $dividedrounds = round($wordscounts / 100);
                if ($dividedrounds == 0) {
                    $readingtimes = 1;
                } else {
                    $readingtimes = $dividedrounds;
                }
                
            @endphp
            <p style="float:right;">{{ $readingtimes }} MIN READ </p><br><br>
            <a href="front/{{ $post->slug }}" id="fronttitlelinks">
                <h1 style="padding:0px; ">{{ $post->title }}</h1>
            </a>
            <hr>
            <p style="font-size:18px;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi explicabo
                asperiores molestiae aliquid magni amet adipisci repudiandae ut aliquam sed quaerat deleniti, nobis
                fugiat tempore sunt dolores. Maxime, magni veniam?</p>

            <p style="float:left;bottom:0px;position:absolute;">{{ $post->user->name }}</p>
            <a href="/front/category/{{ $post->category->catslug }}"
                style="color: #fff;background: #01e08f;border: 1px solid #01e08f;padding: 5.5px 20px;border-radius: 30px;font-size: 12px;font-weight: 700;text-transform: capitalize;
    letter-spacing: 5px;float:right;text-decoration:none;position:absolute;bottom:0px;right:0px;">{{ $post->category->catname }}</a>


        </div>

        <hr>
    </div>

@empty
    <h1 style="color:#01e08f">No Posts Found !</h1>
@endforelse

{!! $posts->withQueryString()->links('pagination::bootstrap-5') !!}
