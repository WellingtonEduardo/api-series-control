<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {

        return Series::all();
    }



    public function store(Request $request)
    {

        return Series::create($request->all());
    }

    public function show(Series $series)
    {

        return $series;
    }


    public function update(Series $series, Request $request)
    {
        return $series->update($request->all());
    }


    public function destroy(Series $series)
    {
        return $series->delete();
    }
}
