<?php

namespace App\Http\Controllers;

use App\Scale;
use Illuminate\Http\Request;
use Validator;

class ScaleController extends Controller
{
    //
    public function index() {

        // retrieve all scales
        $scales = Scale::all();

        // check if record was returned
        if( $scales->count() == 0) {
            // return a response message
            return response()->json([
                'message' => 'No gradation scale record found',
                'data' => []
            ], 200);
        }

        // return json response with data
        return response()->json([
            'message' => 'No gradation scale record found',
            'data' => $scales
        ], 200);
    }

    public function store(Request $request) {
        // validate request inputs
        $validator = Validator::make(
            $request->all(),
            [
                'monthly' => 'required',
                'rate' => 'required'
            ]
        );

        // check for validation errors
        if( $validator->fails() ) {
            // respond with validation errors
            return response()->json([
                'title' => 'Request validation error',
                'message' => $validator->errors(),
                'data' => []
            ], 422);
        }

        // instantiate scale
        $scale = new Scale;

        $scale->monthly = $request->input('monthly');
        $scale->rate = $request->input('rate');

        $scale->save();

        // response json, applicant updated
        return response()->json([
            'message' => 'Scale Added',
            'data' => null
        ], 200);

    }

    public function percentages() {
        $scales = Scale::all();

        $values = [];

        foreach($scales as $scale) {
            $values[] = $scale->monthly * $scale->rate;
        }



        return response()->json(
            ['data' => $values]
        );
    }
}
