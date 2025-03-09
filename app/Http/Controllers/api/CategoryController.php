<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Validation\ValidationException;


class CategoryController extends Controller
{
    //
    public function index(){
        $category = Category::get();
        if($category->count() > 0){
            return CategoryResource::collection($category);
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
                'name' => 'required|unique:categories|max:255',
                'description' => 'nullable|string',
            ]);

            // Create the category record with validated data
            $category = Category::create($validatedData);

            // Return a success response with the created category
            return response()->json([
                'message' => 'Category created successfully',
                'data' => new CategoryResource($category),
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
                'message' => 'An error occurred while creating the category',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        // Find the category by ID. If not found, return a 404 error with a message.
        $category = Category::find($id);

        if ($category) {
            // Return only the data as JSON, without a message
            return new CategoryResource($category);
        } else {
            // If no category is found, return a 404 not found error with a message
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }
    }
    
    public function update(Request $request, $id)
    {

        // Find the category by ID. If not found, return a 404 error.
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        try{

            // Validate incoming request data
            $validatedData = $request->validate([
                'name' => 'required|unique:categories,name,' . $category->id . '|max:255',
                'description' => 'nullable|string',
            ]);

            // Update the category record
            $category->update($validatedData);

            // Return the updated category data
            return response()->json([
                'data' => new CategoryResource($category),
            ], 200); } catch (\Illuminate\Validation\ValidationException $e) {
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
        // Find the category by ID. If not found, return a 404 error.
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        // Delete the category record
        $category->delete();

        // Return a success response
        return response()->json([
            'message' => 'Category deleted successfully'
        ], 200);
    }
}
