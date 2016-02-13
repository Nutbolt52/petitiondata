<?php

namespace App\Helpers;

use Cache;
use Storage;

class updatePetitionData
{
    public static function get($petitionID)
    {
        //fetch data from Redis for this Petition ID if it exists. If not fetch and put in Redis Cache
        if (Cache::has($petitionID)) {
            $data = Cache::get($petitionID);

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

            return $data['data'];
        }
    }
}