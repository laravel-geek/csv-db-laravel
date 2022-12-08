@extends('layout')

    @section('content')

        <div class="container">
            <h1>import/export results</h1>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">http type</th>
                            <th scope="col">route/handler</th>
                            <th scope="col">status</th>
                            <th scope="col">duration (sec)</th>
                            <th scope="col">start time (gmt)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>post</td>
                            <td>{{$laravel['type']}}</td>
                            <td>{{$laravel['status']}}</td>
                            <td>{{$laravel['time']}}</td>
                            <td>{{$laravel['start']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>post</td>
                            <td>{{$spatie['type']}}</td>
                            <td>{{$spatie['status']}}</td>
                            <td>{{$spatie['time']}}</td>
                            <td>{{$spatie['start']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>post</td>
                            <td>{{$php['type']}}</td>
                            <td>{{$php['status']}}</td>
                            <td>{{$php['time']}}</td>
                            <td>{{$php['start']}}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    @endsection
