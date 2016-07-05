<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Datatables;
use App\Helpers\updatePetitionData;
use App\Helpers\recentSearches;

class PetitionData extends Controller
{
    public function home() {
        $searches = recentSearches::get();

        return view('home', ['searches' => $searches]);
    }

    public function RequestData(Request $request)
    {
        $this->validate($request, [
            'petition_id' => 'required|numeric'
        ]);

        return redirect('/' . $request->petition_id);
    }

    public function GetAndDisplayData($petitionID)
    {
        $searchcount = true;
        $data = updatePetitionData::get($petitionID, $searchcount);

        if (isset($data['error'])) {
            return Redirect('/')->with('error', $data['error']);
        }

        return view('PetitionData', $data);

    }

    public function ConstituencyData($petitionID)
    {
        $searchcount = false;
        $data = updatePetitionData::get($petitionID, $searchcount);

        if (isset($data['error'])) {
            return Redirect('/')->with('error', $data['error']);
        }

        $constituencyData = $data['attributes']['signatures_by_constituency'];

        $constituencyDataCollection = collect($constituencyData);

        return Datatables::of($constituencyDataCollection)
            ->editColumn('signature_count', function ($constituencyDataCollection){
                return number_format($constituencyDataCollection['signature_count']);})
            ->make(true);
    }

    public function CountryData($petitionID)
    {
        $searchcount = false;
        $data = updatePetitionData::get($petitionID, $searchcount);

        if (isset($data['error'])) {
            return Redirect('/')->with('error', $data['error']);
        }

        $countryData = $data['attributes']['signatures_by_country'];

        $countryDataCollection = collect($countryData);

        return Datatables::of($countryDataCollection)
            ->editColumn('signature_count', function ($countryDataCollection){
                return number_format($countryDataCollection['signature_count']);})
            ->make(true);
    }
}
