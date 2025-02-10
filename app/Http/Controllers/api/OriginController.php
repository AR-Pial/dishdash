<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Origin;
use App\Http\Resources\OriginResource;
use Illuminate\Validation\ValidationException;

class OriginController extends Controller
{
    public function index(){
        $origin = Origin::get();
        if($origin->count() > 0){
            return OriginResource::collection($origin);
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
                'name' => 'required|unique:origins|max:255',
                'description' => 'nullable|string',
            ]);

            // Create the origin record with validated data
            $origin = Origin::create($validatedData);

            // Return a success response with the created origin
            return response()->json([
                'message' => 'Origin created successfully',
                'data' => new OriginResource($origin),
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
                'message' => 'An error occurred while creating the origin',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        // Find the origin by ID. If not found, return a 404 error with a message.
        $origin = Origin::find($id);

        if ($origin) {
            // Return only the data as JSON, without a message
            return new OriginResource($origin);
        } else {
            // If no origin is found, return a 404 not found error with a message
            return response()->json([
                'message' => 'Origin not found'
            ], 404);
        }
    }
    
    public function update(Request $request, $id)
    {
        // Find the origin by ID. If not found, return a 404 error.
        $origin = Origin::find($id);

        if (!$origin) {
            return response()->json([
                'message' => 'Origin not found'
            ], 404);
        }

        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|unique:origins,name,' . $origin->id . '|max:255',
            'description' => 'nullable|string',
        ]);

        // Update the origin record
        $origin->update($validatedData);

        // Return the updated origin data
        return response()->json([
            'data' => new OriginResource($origin),
        ], 200);
    }
    public function destroy($id)
    {
        // Find the origin by ID. If not found, return a 404 error.
        $origin = Origin::find($id);

        if (!$origin) {
            return response()->json([
                'message' => 'Origin not found'
            ], 404);
        }

        // Delete the origin record
        $origin->delete();

        // Return a success response
        return response()->json([
            'message' => 'Origin deleted successfully'
        ], 200);
    }
}
