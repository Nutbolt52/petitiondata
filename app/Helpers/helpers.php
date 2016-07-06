<?php

namespace App\Helpers;

use Cache;
use Storage;
use Illuminate\Support\Collection;

class updatePetitionData
{
    public static function get($petitionID, $searchcount)
    {
        //fetch data from Redis for this Petition ID if it exists. If not fetch and put in Redis Cache
        if (Cache::has($petitionID)) {
            $data = Cache::get($petitionID);
            if ($searchcount) {
                recentSearches::update($petitionID, $data['data']['attributes']['action']);
            }

            return $data['data'];

        } else {

            try {
                $url = 'https://petition.parliament.uk/petitions/' . $petitionID . '.json';

                $data = json_decode(file_get_contents($url), true);
            } catch (\Exception $e) {
                return ['error' => 'Sorry, something went wrong. Please ensure you used the correct Petition ID, or try again later'];
            }

            if (!$data) {
                return ['error' => 'Sorry, there doesn\'t seem to be a petition with the ID ' . $petitionID . '. Please ensure you are using the correct ID'];
            }

            Cache::put($petitionID, $data, 2);

            recentSearches::update($petitionID, $data['data']['attributes']['action']);

            return $data['data'];
        }
    }
}

class recentSearches
{
    public static function get()
    {
        //Retrieve the most recent searches from the cache
        return Cache::get('recentSearches');
    }

    public static function update($petitionID, $title)
    {
        //Update the most recent searches when someone makes a new search
        $Searches = new Collection;

        if (Cache::has('recentSearches')) {
            $Searches = collect(Cache::get('recentSearches'));
        }

        try {
            if ($Searches->contains('petitionID', $petitionID)) {
                $temp_search = $Searches->pull($petitionID);
                $temp_search['count'] = $temp_search['count'] + 1;
                $Searches->push($temp_search);
            } else {
                //dd($Searches->count());
                if ($Searches->count() > 14) {
                    //dd($Searches->count());
                    $Searches->pop();
                }
                $Searches = $Searches->merge([['petitionID' => $petitionID, 'title' => $title, 'count' => 1]]);
            }

            $Searches = $Searches->keyBy('petitionID');
            $Searches = $Searches->sortByDesc('count');
            Cache::forget('recentSearches');
            Cache::forever('recentSearches', $Searches);

            return true;
        } catch (\Exception $e) {
            return ['error' => 'Sorry, there was an issue with the recent searches list, please try again'];
        }
    }
}