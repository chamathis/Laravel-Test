@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach ($filmList as $film)
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-3 col-md-3 text-center">
                                <img src="{{asset('images')."/".$film->photo_url}}" alt="bootsnipp"
                                     class="img-rounded img-responsive" />
                            </div>
                            <div class="col-xs-9 col-md-9 section-box">
                                <h2>
                                    <a href="/films/{{$film->slug}}">{{$film->name}}</a>
                                </h2>
                                <p>{{$film->desc}}</p>
                                <hr />
                                <div class="row rating-desc">
                                    <div class="col-md-12">
                                        Rating  <strong>{{$film->rating}}</strong> <span class="separator">|</span>
                                        Ticket Price  <strong>{{$film->ticket_price}}</strong> <span class="separator">|</span>
                                        Country <strong>{{$film->country}}</strong> <span class="separator">|</span>
                                        Release Date <strong>{{$film->release_date}}</strong> <span class="separator">|</span>
                                        Genre
                                        @foreach ($film->genres as $genre)
                                            <strong>{{$genre->name}},</strong>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
