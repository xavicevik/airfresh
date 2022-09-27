<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\MilitanteResource;
use App\Http\Resources\ArchivoResource;
use App\Models\Archivo;
use App\Models\Militante;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Validator;

class MilitanteController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $militantes = Militante::all();

        return $this->sendResponse(MilitanteResource::collection($militantes), 'Products retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $militantes = Militante::create($input);

        return $this->sendResponse(new MilitanteResource($militantes), 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $militantes = Militante::find($id);

        if (is_null($militantes)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new MilitanteResource($militantes), 'Militante retrieved successfully.');
    }

    public function getMilitantebyDoc(Request $request)
    {
        $militante = Militante::where('documento', $request->documento)->first();

        if (is_null($militante)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new MilitanteResource($militante), 'Militante retrieved successfully.');
    }

    public function getFilesbyMilitante(Request $request)
    {
        $archivos = Archivo::where('idmilitante', $request->idmilitante)->get();

        if (is_null($archivos)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(ArchivoResource::collection($archivos), 'Products retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Militante $militantes)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $militantes->name = $input['name'];
        $militantes->detail = $input['detail'];
        $militantes->save();

        return $this->sendResponse(new MilitanteResource($militantes), 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Militante $militantes)
    {
        $militantes->delete();

        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
