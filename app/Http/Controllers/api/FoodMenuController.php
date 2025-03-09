<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FoodMenu;
use App\Http\Resources\FoodMenuResource;
use Illuminate\Validation\ValidationException;
class FoodMenuController extends Controller
{
    //
    public function index(){
        $foodMenu = FoodMenu::get();
        if($foodMenu->count() > 0){
            return FoodMenuResource::collection($foodMenu);
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
                'food_item_name' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'price' => 'required|numeric',
                'unit_id' => 'nullable|exists:units,id',  // Assuming the unit_id exists in the units table
                'category_id' => 'nullable|exists:categories,id', // Category is optional
                'sub_category_id' => 'nullable|exists:sub_categories,id', // Sub-category is optional
                'origin_id' => 'nullable|exists:origins,id', // Origin is optional
            ]);

            $foodMenu = FoodMenu::create($validatedData);

            return response()->json([
                'message' => 'Food Menu created successfully',
                'data' => new FoodMenuResource($foodMenu),
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
                'message' => 'An error occurred while creating the Food Menu',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        $foodMenu = FoodMenu::find($id);

        if ($foodMenu) {
            return new FoodMenuResource($foodMenu);
        } else {
            return response()->json([
                'message' => 'Food Menu not found'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        // Find the food menu item by ID. If not found, return a 404 error.
        $foodMenu = FoodMenu::find($id);

        if (!$foodMenu) {
            return response()->json([
                'message' => 'Food Menu not found'
            ], 404);
        }
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'food_item_name' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'price' => 'required|numeric',
                'unit_id' => 'nullable|exists:units,id',  // Assuming the unit_id exists in the units table
                'category_id' => 'nullable|exists:categories,id', // Category is optional
                'sub_category_id' => 'nullable|exists:sub_categories,id', // Sub-category is optional
                'origin_id' => 'nullable|exists:origins,id', // Origin is optional
            ]);
    
            // Update the food menu record
            $foodMenu->update($validatedData);
    
            // Return the updated food menu data
            return response()->json([
                'data' => new FoodMenuResource($foodMenu),
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
        // Find the category by ID. If not found, return a 404 error.
        $foodMenu = FoodMenu::find($id);

        if (!$foodMenu) {
            return response()->json([
                'message' => 'Food Menu not found'
            ], 404);
        }

        // Delete the category record
        $foodMenu->delete();

        // Return a success response
        return response()->json([
            'message' => 'Food Menu deleted successfully'
        ], 200);
    }
    


}
