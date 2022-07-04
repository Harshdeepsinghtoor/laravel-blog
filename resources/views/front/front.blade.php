@extends('layouts.app')

@section('content')
    {{-- <div style="margin-left:20px;"><img src="{{ URL::asset('images/assets/Logos.png') }}" alt="Logos" width="206.33px"
            height="40px"></div> --}}
    <div class="container py-5">

        <h1 style="font-weight: 700;font-size: 60px;color: #013870;margin-bottom: 20px;">The Puffin Post</h1>
        <p style="font-weight: 400;font-size: 28px;line-height: 42px;color: #013870;">Your home for insights into the RFP
            process, guest posts, community discussions, and company updates.</p>


        <div><select id="lang" class="categoryajax"
                style="background-color: #01e08f;border: none;border-radius: 30px;padding: 10px 40px 10px 30px;color: #fff;font-size: 20px;background-image: url(/images/selectarrow.svg?366f6d9…);background-repeat: no-repeat;background-position: right 25px center;-webkit-appearance: none;-moz-appearance: none;appearance: none;border:none;">
                <option value="most-recent">Most recent &#8964;</option>
                <option value="oldest">Oldest</option>

                @forelse ($categories as $category)
                    <option value={{ $category->id }}>{{ $category->catname }}</option>

                @empty
                @endforelse
            </select></div>
        <hr>
        <div class="dynamiccatdatadiv">
            {{-- Ajax Loading Images --}}
            <div class="ajax-loaders">
                <img src="{{ URL::asset('/images/assets/AjaxLoading.gif') }}" class="img-responsive" />
            </div>



            @forelse ($posts as $post)
                <div style="margin-bottom: 105px;display:flex;">
                    <div class="photodiv">
                        <a href="/front/{{ $post->slug }}">
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
                                $readingtimes="LESS THAN 1";
                            } else {
                                $readingtimes = $dividedrounds;
                            }
                            
                        @endphp
                        <p style="float:right;">{{ $readingtimes }} MIN READ </p><br><br>
                        <a href="/front/{{ $post->slug }}" id="fronttitlelinks">
                            <h1 style="padding:0px; ">{{ $post->title }}</h1>
                        </a>
                        <hr>
                        <p style="font-size:18px;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sequi explicabo
                            asperiores molestiae aliquid magni amet adipisci repudiandae ut aliquam sed quaerat deleniti,
                            nobis fugiat tempore sunt dolores. Maxime, magni veniam?</p>

                        <p style="float:left;bottom:0px;position:absolute;">By {{ $post->user->name }}</p>
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
        </div>
        {{-- Ajax Paginations Starts --}}
        <script>
            window.addEventListener('hashchange', function() {
                alert("Hello You Changed The Adreses");
            });
        </script>


        {{-- Ajax Paginations Endings Heres --}}



        {{-- Ajax Experiments --}}

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".categoryajax").change(function(e) {


                // var checkboxc = $(this);

                var category_id = $(this).val();
                // alert(category_id);
                e.preventDefault();
                var paramitr = category_id;
                $.ajax({
                    type: 'POST',
                    beforeSend: function() {
                        $('.ajax-loaders').css("display", "inline-block");
                    },
                    url: '/front',
                    data: {
                        category_id: paramitr
                    },
                    success: function(data) {
                        $(".dynamiccatdatadiv").html(data);
                        // var obj = jQuery.parseJSON(data);
                        // console.log();
                        // if (obj.status != '' && obj.status == 1) {

                        //     checkboxc.prop('checked', true);
                        //     checkboxc.parent().prev('.refreshing').find('span').css({
                        //         'background-color': 'green',
                        //         'color': 'white',
                        //         'border': 'none'
                        //     });
                        //     checkboxc.parent().prev('.refreshing').find('span').text('Published');
                        // } else {
                        //     checkboxc.prop('checked', false);
                        //     checkboxc.parent().prev('.refreshing').find('span').css({
                        //         'background-color': 'white',
                        //         'color': '#dc3545',
                        //         'border': '1px solid #dc3545'
                        //     });
                        //     checkboxc.parent().prev('.refreshing').find('span').text('Unpublish');

                        // }

                        $('.ajax-loaders').css("display", "none");

                    },
                    complete: function() {
                        // $('.ajax-loaders').css("visibility", "hidden");
                    }

                    //       error: function (jqXHR, exception) {
                    //     var msg = '';
                    //     if (jqXHR.status === 0) {
                    //         msg = 'Not connect.\n Verify Network.';
                    //     } else if (jqXHR.status == 404) {
                    //         msg = 'Requested page not found. [404]';
                    //     } else if (jqXHR.status == 500) {
                    //         msg = 'Internal Server Error [500].';
                    //     } else if (exception === 'parsererror') {
                    //         msg = 'Requested JSON parse failed.';
                    //     } else if (exception === 'timeout') {
                    //         msg = 'Time out error.';
                    //     } else if (exception === 'abort') {
                    //         msg = 'Ajax request aborted.';
                    //     } else {
                    //         msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    //     }
                    //     alert(msg);
                    // },

                });

            });

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        </script>

        {{-- Ajax Experiments Endings --}}



    </div>
@endsection
