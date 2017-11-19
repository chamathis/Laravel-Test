@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-area">
                    <form role="form" id="genre-form">
                        <br style="clear:both">
                        <h3 style="margin-bottom: 25px; text-align: center;">Add New Genre</h3>
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            <input type="hidden" class="form-control" id="genre_id" name="genre_id">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" type="textarea" id="desc" name="desc" placeholder="Description"></textarea>
                        </div>
                        <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">Submit Form</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <br><br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Genres</h3>
                    </div>

                    <table class="table table-hover" id="genreTbl">
                        <thead>
                        <tr>
                            <th>Genre</th>
                            <th>Desc</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

