<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index(Request $request, Series $series)
    {
        return $series->episodes;
    }

    public function show(Series $series, int $id)
    {
        return $series->episodes()->find($id);
    }
}
