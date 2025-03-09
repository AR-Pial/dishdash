<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Http\Resources\UnitResource;
use Illuminate\Validation\ValidationException;

class UnitController extends Controller
{
    //
    public function index(){
        $unit = Unit::get();
        if($unit->count() > 0){
            return UnitResource::collection($unit);
        }
        else{
            return response()->json(['message' => 'No record available'],200);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required|unique:units|max:255',
                'description' => 'nullable|string',
            ]);

            // Create the unit record with validated data
            $unit = Unit::create($validatedData);

            // Return a success response with the created unit
            return response()->json([
                'message' => 'Unit created successfully',
                'data' => new UnitResource($unit),
            ], 200);

        } catch (ValidationException $e) {
            // Handle validation errors (if any)
            return response()->json([
                'message' => 'Validation errors occurred',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json([
                'message' => 'An error occurred while creating the unit',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        // Find the unit by ID. If not found, return a 404 error with a message.
        $unit = Unit::find($id);

        if ($unit) {
            // Return only the data as JSON, without a message
            return new UnitResource($unit);
        } else {
            // If no unit is found, return a 404 not found error with a message
            return response()->json([
                'message' => 'Unit not found'
            ], 404);
        }
    }
    
    public function update(Request $request, $id)
    {
        // Find the unit by ID. If not found, return a 404 error.
        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json([
                'message' => 'Unit not found'
            ], 404);
        }

        try{
            // Validate incoming request data
            $validatedData = $request->validate([
                'name' => 'required|unique:units,name,' . $unit->id . '|max:255',
                'description' => 'nullable|string',
            ]);

            // Update the unit record
            $unit->update($validatedData);

            // Return the updated unit data
            return response()->json([
                'data' => new UnitResource($unit),
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors and return them with a 422 Unprocessable Entity status
            return response()->json([
                'message' => 'Validation errors occurred',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Handle general errors (e.g., database issues, unknown errors)
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function destroy($id)
    {
        // Find the unit by ID. If not found, return a 404 error.
        $unit = Unit::find($id);

        if (!$unit) {
            return response()->json([
                'message' => 'Unit not found'
            ], 404);
        }

        // Delete the unit record
        $unit->delete();

        // Return a success response
        return response()->json([
            'message' => 'Unit deleted successfully'
        ], 200);
    }
}
