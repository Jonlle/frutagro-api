<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Estado;
use App\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddressController extends BaseController
{
    /**
     * Display a listing of the states.
     *
     * @return \Illuminate\Http\Response
     */
    public function estados()
    {
        $estados = Estado::all();

        return $this->sendResponse($estados, 'States has been retrieved successfully.');
    }

    /**
     * Display a list of cities belonging to a specific state.
     *
     * @return \Illuminate\Http\Response
     */
    public function ciudades($id)
    {
        $estado = Estado::findOrFail($id);

        $ciudades = $estado->ciudades;

        return $this->sendResponse($ciudades, 'Cities has been retrieved successfully.');
    }

    /**
     * Display a list of municipalities belonging to a specific state.
     *
     * @return \Illuminate\Http\Response
     */
    public function municipios($id)
    {
        $estado = Estado::findOrFail($id);

        $municipios = $estado->municipios;

        return $this->sendResponse($municipios, 'Municipalities has been retrieved successfully.');
    }

    /**
     * Display a list of parishes belonging to a specific municipality.
     *
     * @return \Illuminate\Http\Response
     */
    public function parroquias($id)
    {
        $municipio = Municipio::findOrFail($id);

        $parroquias = $municipio->parroquias;

        return $this->sendResponse($parroquias, 'Parishes has been retrieved successfully.');
    }
}
