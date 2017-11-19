<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('genre') }}">Genre</a></li>
                        <li><a href="{{ route('newfilm') }}">Add New Film</a></li>
                        <li><a href="{{ route('films') }}">Films</a></li>
                        {{--<li><a href="{{ route('films') }}">All Films</a></li>--}}
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        var host = window.location.protocol+"//"+window.location.host;
        $(document).ready(function(){

            console.log(host);

            getGenreList();

            $("#genre-form").submit(function(event){
                var genreForm = $(this);
                var gnId = $("#genre_id").val();
                var apiPath;
                if(gnId>0){
                    apiPath = host+"/api/genre/update/"+gnId;
                }else{
                    apiPath = host+"/api/genre/create";
                }
                $.ajax({
                    url : apiPath,
                    type: "POST",
                    data : $(this).serialize()
                }).done(function(response){
                    if(response.error == 0){
                        alert(response.success);
                        genreForm.find("input[type=text], input[type=hidden],textarea").val("");
                        getGenreList();
                    }else{
                        alert(response.error);
                    }
                });
                event.preventDefault();
            });

            $("#film-form").submit(function(event){

                var formData = new FormData($(this)[0]);
                var currForm = $(this);
                $.ajax({
                    data: formData,
                    contentType: false,
                    processData: false,
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    success: function(response) {
                        if(response.error == 0){
                            alert(response.success);
                            currForm[0].reset();
                            getGenreList();
                        }else{
                            alert(response.error);
                        }
                    }
                });
                return false;
                event.preventDefault();
            });

            $("#comment-form").submit(function(event){
                var commentForm = $(this);

                $.ajax({
                    url : host+"/api/film/comment/create",
                    method: "POST",
                    data : $(this).serialize()
                }).done(function(response){
                    if(response.error == 0){
                        alert(response.success);
                    }else{
                        alert(response.error);
                    }
                });
                event.preventDefault();
            });





        });


        $( "div").on( "click",".delete-genre", function(e) {
            var gId = $(this).attr("id");
            $.ajax({
                url : host+"/api/genre/delete/"+gId,
                method: "DELETE",
                data :""
            }).done(function(response){
               if(response.error==0){
                   alert(response.success);
                   getGenreList();
               }
            });
            e.stopPropagation();
        });

        $( "div").on( "click",".update-genre", function(e) {
            var gId = $(this).attr("id");
            $.ajax({
                url : host+"/api/genre/"+gId,
                method: "GET",
                data :""
            }).done(function(response){
                if(response){
                    $("#genre_id").val(response.genre_id);
                    $("#name").val(response.name);
                    $("#desc").val(response.desc);
                }
            });
            e.stopPropagation();
        });

        function getGenreList (){
            $.ajax({
                url : host+"/api/genre/all",
                type: "GET",
                data : ""
            }).done(function(response){
                var tblRow;
                if(response.length){
                    response.forEach(function(res, index) {
                        tblRow += "<tr><td>"+res.name+"</td><td>"+res.desc+"</td><td><button id="+res.genre_id+" class='delete-genre btn btn-danger btn-sm'>Delete</button><button id="+res.genre_id+" class='update-genre btn btn-warning btn-sm'>Edit</button></td></tr>";
                    });
                    console.log(tblRow);
                    $("#genreTbl tbody").html(tblRow);
                }
            });
        }


    </script>

</body>
</html>
