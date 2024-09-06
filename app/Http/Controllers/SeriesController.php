<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
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
        $series = Series::create([
            'name' => $request->name,
        ]);

        $seasons = [];
        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $seasons[] = [
                'series_id' => $series->id,
                'number' => $i,
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach ($series->seasons as $season) {
            for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number' => $j
                ];
            }
        }
        Episode::insert($episodes);
        return $series;


    }

    public function show(Series $series)
    {

        return $series;
    }


    public function update(Request $request, Series $series)
    {

        $series->update($request->all());

        $existingSeasons = $series->seasons()->with('episodes')->get()->keyBy('number');

        $newSeasons = [];
        $newEpisodes = [];

        for ($i = 1; $i <= $request->seasonsQty; $i++) {
            $season = $existingSeasons->get($i);

            if (!$season) {

                $newSeasons[] = [
                    'series_id' => $series->id,
                    'number' => $i,
                ];
            } else {

                $existingEpisodes = $season->episodes->keyBy('number');

                for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                    if (!$existingEpisodes->has($j)) {

                        $newEpisodes[] = [
                            'season_id' => $season->id,
                            'number' => $j,
                        ];
                    }
                }
            }
        }


        if (!empty($newSeasons)) {
            Season::insert($newSeasons);
        }

        if (!empty($newEpisodes)) {
            Episode::insert($newEpisodes);
        }


        $series->seasons()->where('number', '>', $request->seasonsQty)->delete();


        Episode::whereIn('season_id', $series->seasons->pluck('id'))
            ->where('number', '>', $request->episodesPerSeason)
            ->delete();

        return $series;

    }


    public function destroy(Series $series)
    {
        return $series->delete();
    }
}
