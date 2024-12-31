<?php

namespace App\Http\Controllers\api;
use App\Models\Table;
use App\Http\Controllers\Controller;
use App\Http\Resources\TableResource;
use Illuminate\Http\Request;


class TableController extends Controller
{
    //
    public function index(){
        $tables = Table::get();
        if($tables->count() > 0){
            return TableResource::collection($tables);
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
                'table_number' => 'required|unique:tables|max:255',
                'floor_number' => 'required|unique:tables|max:255',
                'total_seat' => 'required|integer',
                'hourly_price' => 'required|numeric',
                'status' => 'required|in:available,reserved,occupied,unavailable',
                'type' => 'required|in:premium,cabin,business,economy',
            ]);

            // Create the table record with validated data
            $table = Table::create($validatedData);

            // Return a success response with the created table
            return response()->json([
                'message' => 'Table created successfully',
                'data' => new TableResource($table),
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors (if any)
            return response()->json([
                'message' => 'Validation errors occurred',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json([
                'message' => 'An error occurred while creating the table',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        // Find the table by ID. If not found, return a 404 error with a message.
        $table = Table::find($id);

        if ($table) {
            // Return only the data as JSON, without a message
            return new TableResource($table);
        } else {
            // If no table is found, return a 404 not found error with a message
            return response()->json([
                'message' => 'Table not found'
            ], 404);
        }
    }
    

    public function update(Request $request, $id)
    {
        // Find the table by ID. If not found, return a 404 error.
        $table = Table::find($id);

        if (!$table) {
            return response()->json([
                'message' => 'Table not found'
            ], 404);
        }

        // Validate incoming request data
        $validatedData = $request->validate([
            'table_number' => 'required|max:255', // Removed 'unique'
            'floor_number' => 'nullable|string|max:255',
            'total_seat' => 'required|integer',
            'hourly_price' => 'required|numeric',
            'status' => 'required|in:available,reserved,occupied,unavailable',
            'type' => 'required|in:premium,cabin,business,economy',
        ]);

        // Update the table record
        $table->update($validatedData);

        // Return the updated table data
        return response()->json([
            'data' => new TableResource($table),
        ], 200);
    }
    public function destroy($id)
    {
        // Find the table by ID. If not found, return a 404 error.
        $table = Table::find($id);

        if (!$table) {
            return response()->json([
                'message' => 'Table not found'
            ], 404);
        }

        // Delete the table record
        $table->delete();

        // Return a success response
        return response()->json([
            'message' => 'Table deleted successfully'
        ], 200);
    }




}
