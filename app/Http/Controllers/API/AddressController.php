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

        return $this->sendResponse(trans('response.success_state_index'), $states);
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

        return $this->sendResponse(trans('response.success_city_index'), $cities);
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

        return $this->sendResponse(trans('response.success_municipality_index'), $municipalities );
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

        return $this->sendResponse(trans('response.success_parish_index'), $parishes);
    }
}
