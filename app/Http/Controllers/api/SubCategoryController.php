<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Http\Resources\SubCategoryResource;
use Illuminate\Validation\ValidationException;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $sub_category = SubCategory::get();
        if($sub_category->count() > 0){
            return SubCategoryResource::collection($sub_category);
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
                'name' => 'required|unique:sub_categories|max:255',
                'category_id' => 'nullable|exists:categories,id',
                'description' => 'nullable|string',
            ]);

            // Create the sub_category record with validated data
            $sub_category = SubCategory::create($validatedData);

            // Return a success response with the created sub_category
            return response()->json([
                'message' => 'SubCategory created successfully',
                'data' => new SubCategoryResource($sub_category),
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
                'message' => 'An error occurred while creating the sub_category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        // Find the sub_category by ID. If not found, return a 404 error with a message.
        $sub_category = SubCategory::find($id);

        if ($sub_category) {
            // Return only the data as JSON, without a message
            return new SubCategoryResource($sub_category);
        } else {
            // If no sub_category is found, return a 404 not found error with a message
            return response()->json([
                'message' => 'SubCategory not found'
            ], 404);
        }
    }
    
    public function update(Request $request, $id)
    {
        // Find the sub_category by ID. If not found, return a 404 error.
        $sub_category = SubCategory::find($id);

        if (!$sub_category) {
            return response()->json([
                'message' => 'SubCategory not found'
            ], 404);
        }
        try{
            // Validate incoming request data
            $validatedData = $request->validate([
                'name' => 'required|unique:sub_categories,name,' . $sub_category->id . '|max:255',
                'category_id' => 'nullable|exists:categories,id',
                'description' => 'nullable|string',
            ]);

            // Update the sub_category record
            $sub_category->update($validatedData);

            // Return the updated sub_category data
            return response()->json([
                'data' => new SubCategoryResource($sub_category),
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
        // Find the sub_category by ID. If not found, return a 404 error.
        $sub_category = SubCategory::find($id);

        if (!$sub_category) {
            return response()->json([
                'message' => 'SubCategory not found'
            ], 404);
        }

        // Delete the sub_category record
        $sub_category->delete();

        // Return a success response
        return response()->json([
            'message' => 'SubCategory deleted successfully'
        ], 200);
    }
}
