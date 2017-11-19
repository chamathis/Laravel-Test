<?php

namespace App\Http\Controllers;

use App\Film;
use App\Filmgenre;
use Illuminate\Http\Request;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Validator;
use App\Genre;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {



        $filmList = Film::with('genres')->orderby('film_id', 'asc')->get();
        $data = array(
            'filmList'=>$filmList
        );

        return view('filmlist')->with($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genreList = Genre::orderby('genre_id', 'asc')->get();
        $data = array(
            'genreList'=>$genreList
        );


        return view('add')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $vMsgs = [];

        $film =  new Film;

        $film->name = $request->input('name');
        $film->desc = $request->input('desc');
        $film->release_date = $request->input('releaseDate');
        $film->ticket_price = $request->input('price');
        $film->country = $request->input('country');
        $film->rating = $request->input('rating');



        $request->request->add(['slug' => str_slug($request->input('name'))]);


        $v = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'desc' => 'required',
            'releaseDate' => 'required',
            'price' => 'required',
            'country' => 'required',
            'rating' => 'required',
            'genre_id' => 'required'
        ]);

        $slug = str_slug($request->input('name'));
        //$checkSlug = Film::where('slug',$slug)->first();

        function getRelatedSlugs($slug){
            if (!is_null( Film::select('slug')->where('slug', 'like', $slug.'%')->first())) {
                for ($i = 1; $i <= 10; $i++) {
                    $newslug = $slug."-".$i;
                    if (is_null( Film::select('slug')->where('slug', 'like', $newslug.'%')->first())) {
                        return $newslug;
                    }

                }
            }else{
                return $slug;
            }
        }

        $image = $request->file('image');
        $film->slug = getRelatedSlugs($slug);


        if($image){
            $img = time().'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('/images');

            $image->move($destinationPath, $img);


            $film->photo_url = $img;
        }else{
            $film->photo_url = null;
        }


        if ($v->fails()){
            $vMsgs = [ 'error' => $v->errors()->all(),
                'success' => 0];
        }else{

            $film->save();
            $film_id = $film->film_id;



            foreach ($request->input('genre_id') as $sGenre){
                $genreFilm = new Filmgenre;
                $genreFilm->film_id = $film_id;
                $genreFilm->genre_id = $sGenre;
                $genreFilm->save();
            }
            $vMsgs = [ 'error' => 0,
                'success' => "Dn",
                'film_id' => $film->film_id];

        }

        return response()->json($vMsgs);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {


        $film = Film::whereSlug($slug)->first();

        $cust = DB::table('comments')
            ->select('comments.*', 'users.name')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.film_id', $film->film_id)
            ->get();
        $data = array(
            'film'=>$film,
            'comments' => $cust
        );
        return view('film')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
