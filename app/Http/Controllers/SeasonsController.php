<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index(Series $series)
    {
        return $series->seasons;
    }



    public function show(Series $series, int $id)
    {
        return $series->seasons()->find($id);
    }




}
