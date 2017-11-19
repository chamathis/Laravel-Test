@extends('layouts.app')

@section('content')


 <!-- Page Content -->
   <div class="container">

       <div class="row">

           <!-- Post Content Column -->
           <div class="col-lg-8">

               <!-- Title -->
               <h1 class="mt-4">{{$film->name}}</h1>


               <hr>

               <!-- Date/Time -->
               <p>

                   Rating  <strong>{{$film->rating}}</strong> <span class="separator">|</span>
                   Ticket Price  <strong>{{$film->ticket_price}}</strong> <span class="separator">|</span>
                   Country <strong>{{$film->country}}</strong> <span class="separator">|</span>
                   Release Date <strong>{{$film->release_date}}</strong> <span class="separator">|</span>
                   Genre
                   @foreach ($film->genres as $genre)
                       <strong>{{$genre->name}},</strong>
                   @endforeach
               </p>

               <hr>

               <!-- Preview Image -->
               <img class="img-fluid rounded" src="{{asset('images')."/".$film->photo_url}}" alt="">

               <hr>

               <!-- Post Content -->
               <p class="lead">
                   {{$film->desc}}
               </p>


               <hr>
                @if(Auth::user())
               <!-- Comments Form -->
               <div class="card my-4">
                   <h5 class="card-header">Leave a Comment:</h5>
                   <div class="card-body">
                       <form id="comment-form">
                           <div class="form-group">
                               <textarea class="form-control" rows="3" name="comment"></textarea>
                               <input type="hidden" value="{{$film->film_id}}" name="film_id">
                               <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                           </div>
                           <button type="submit" class="btn btn-primary">Submit</button>
                       </form>
                   </div>
               </div>
               @else
                   <h4>You have to log in to comment</h4>

               @endif

               @foreach($comments as $comment)
                   <div class="media mb-4">
                       <div class="media-body">
                           <h5 class="mt-0">{{$comment->name}}</h5>
                          {{$comment->comment}}
                       </div>
                   </div>
               <hr>
               @endforeach

           </div>



       </div>
       <!-- /.row -->

   </div>
   <!-- /.container -->
@endsection
