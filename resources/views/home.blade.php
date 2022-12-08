@extends('layout')

    @section('content')

        <div class="container align-content-center">
            <div class="row gy-20">
                <div class="col-md-12 align-content-center">
                    <h1>CSV-db import/export Laravel</h1>
                    <br><br>
                    files could be found at "storage/app/public"
                    <br><br>
                </div>
            </div>
            <div class="row gy-20">
                <div class="col-md-2 align-content-center">
                    <a href="/export" class="btn btn-success btn-lg" tabindex="-1" role="button" aria-disabled="true">EXPORT</a>

                </div>
                <div class="col-md-2 align-content-center">
                <a href="/import" class="btn btn-danger btn-lg" tabindex="-1" role="button" aria-disabled="true">IMPORT</a>
                </div>
            </div>
        </div>






    @endsection
