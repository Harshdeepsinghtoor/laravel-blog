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
                        <h1 class="display-one">Our Blog!</h1>
                        <p>Enjoy reading our posts. Click on a post to read!
                        </p>
                    </div>
                    <div class="col-4" style="border:2px dotted gray;border-radius:10px;text-align:center; ">
                        <p style="font-weight:bold;">Create new Post</p>
                        <a href="/blog/create/post" class="btn btn-primary btn-sm">Add Post</a>
                    </div>
                    {{-- <div class="col-2" style="border:2px dotted gray;border-radius:10px; ">
                        <p>Add a new Category</p>
                        <a href="/blog/create/category" class="btn btn-primary btn-sm">Add Category</a>
                    </div> --}}
                </div><hr>
                @forelse($pop as $post)
                    <ul>
                        
                        <li><a href="./blog/{{ $post->slug }}"
                                style="display:inline-block;width:170px;text-decoration:none;"><b>{{ ucfirst($post->title) }}</b></a>
                            {{-- This is the newss Locations --}}
                            
                            <div class="refreshing" style="display: inline-block">
                                @if ($post->publish === 1)
                                    <span class="test"
                                        style="border-radius:6px; color:white;font-weight:bolder;margin-left:10px;background-color:green;padding:5px;width:75px;display:inline-block;">Published</span>
                                @else
                                    <span class="test"
                                        style=" text-align:center;border-radius:6px;border:1px solid #dc3545;color:#dc3545;font-weight:bolder;margin-left:10px;background-color:white;padding:5px;width:75px;display:inline-block;">Unpublish</span>
                                @endif
                            </div>

                            {{-- Toggle Buttons --}}
                            <div class="form-check form-switch form-switch-sm" style="display: inline-block;">
                                <input class="form-check-input mybuttons" data-post_id="{{ $post->id }}"
                                    data-publish-status="{{ $post->publish }}" type="checkbox" name="publish"
                                    @if ($post->publish === 1) {{ 'checked' }} @endif>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Publish</label>
                            </div>
                            {{-- Toggle Buttons Endings --}}
                            {{-- Newss locations endingss --}}
                            <a href="/blog/{{ $post->id }}/edit" class="btn btn-outline-primary"
                                style="margin-left: 50px">Edit Post</a>
                            <form id="delete-frm" class="" action="./blog/{{ $post->id }}" method="POST"
                                style="display:inline;margin-left:5px;">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" onclick="return confirm('Are you sure ?')">Delete
                                    Post</button>
                            </form>
                            {{-- This is prv location --}}

                            {{-- Prv Locations endings --}}

                        </li>
                        <hr>
                    </ul>


                @empty
                    <p class="text-warning">No blog Posts available</p>
                @endforelse
                {!! $pop->withQueryString()->links('pagination::bootstrap-5') !!}



                {{-- Experimenting for the AJAX --}}
                <script type="text/javascript">
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $(".mybuttons").click(function(e) {

                        var checkboxc = $(this);

                        var post_id = $(this).data('post_id')
                        // alert(post_id)
                        e.preventDefault();
                        var paramitr = post_id;
                        $.ajax({
                            type: 'POST',
                            url: '/blog',
                            data: {
                                post_id: paramitr
                            },
                            success: function(data) {
                                var obj = jQuery.parseJSON(data);
                                console.log();
                                if (obj.status != '' && obj.status == 1) {

                                    checkboxc.prop('checked', true);
                                    checkboxc.parent().prev('.refreshing').find('span').css({
                                        'background-color': 'green',
                                        'color': 'white',
                                        'border': 'none'
                                    });
                                    checkboxc.parent().prev('.refreshing').find('span').text('Published');
                                } else {
                                    checkboxc.prop('checked', false);
                                    checkboxc.parent().prev('.refreshing').find('span').css({
                                        'background-color': 'white',
                                        'color': '#dc3545',
                                        'border': '1px solid #dc3545'
                                    });
                                    checkboxc.parent().prev('.refreshing').find('span').text('Unpublish');

                                }

                            }

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

                {{-- Experimenting for the AJAX is ending heres --}}
            </div>
        </div>
    </div>
@endsection
