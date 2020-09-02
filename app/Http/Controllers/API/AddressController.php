<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\State;
use App\Municipality;

class AddressController extends BaseController
{
    /**
     * Display a listing of the states.
     *
     * @return \Illuminate\Http\Response
     */
    public function states()
    {
        $states = State::all();

        return $this->sendResponse('States has been retrieved successfully.', $states);
    }

    /**
     * Display a list of cities belonging to a specific state.
     *
     * @return \Illuminate\Http\Response
     */
    public function cities($id)
    {
        $state = State::findOrFail($id);

        $cities = $state->cities;

        return $this->sendResponse('Cities has been retrieved successfully.', $cities);
    }

    /**
     * Display a list of municipalities belonging to a specific state.
     *
     * @return \Illuminate\Http\Response
     */
    public function municipalities($id)
    {
        $state = State::findOrFail($id);

        $municipalities = $state->municipalities;

        return $this->sendResponse('Municipalities has been retrieved successfully.', $municipalities );
    }

    /**
     * Display a list of parishes belonging to a specific municipality.
     *
     * @return \Illuminate\Http\Response
     */
    public function parishes($id)
    {
        $municipality = Municipality::findOrFail($id);

        $parishes = $municipality->parishes;

        return $this->sendResponse('Parishes has been retrieved successfully.', $parishes);
    }
}
