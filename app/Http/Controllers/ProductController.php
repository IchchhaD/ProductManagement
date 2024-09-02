<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::get();
        return response()->json(['message' => 'Getting Products', 'data' => $products]);
    }
    public function createProducts(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails())
		{
			$response['error'] = true;
			$response['message'] = $validator->errors();
			return response()->json($response);
		}
        try
        {
            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;

            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('public/images', $fileName);

                $product->image =$filePath;
            }

            $product->save();

            return response()->json(['message' => 'Creating Products', 'data' => $product]);
        }
        catch(Exception $e)
        {
            $response['error'] = true;
			$response['message'] = "Something went wrong. Try again!";
			return response()->json($response);
        }       
    }
    public function updateProducts(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails())
		{
			$response['error'] = true;
			$response['message'] = $validator->errors();
			return response()->json($response);
		}
        try
        {
            $product = Product::findOrFail($id);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->save();

            return response()->json(['message' => 'Updating Products', 'data' => $product]);
        }
        catch(Exception $e)
        {
            $response['error'] = true;
			$response['message'] = "Something went wrong. Try again!";
			return response()->json($response);
        }
    }
    public function deleteProducts(Request $request)
    {
        $validator = \Validator::make($request->all(), [
           'id' => 'required|exists:products,id',
        ]);

        if ($validator->fails())
		{
			$response['error'] = true;
			$response['message'] = $validator->errors();
			return response()->json($response);
		}
        try
        {
            $product = Product::find($request->id);
            $delete = $product->delete();

            return response()->json(['message' => 'Product Deleted', 'data' => $product]);
        }
        catch(Exception $e)
        {
            $response['notify'] = true;
			$response['message'] = "Something went wrong. Try again!";
            $response['error'] = $e->getMessage();
			return response()->json($response);
        }
    }
}
