<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

class MainController extends Controller
{
    public function addCard(Request $request)
    {
        $user = $request->user();
        if ($user->role !== 'admin' && $user->role !== 'root') {
            return response()->json([
                "message" => "У вас нет прав администратора."
            ], 403);
        };

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:category,id',
            'material' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        $photo = null;
        if ($request->hasFile('image')) {
            $photo = $request->file('image')->store('photo', 'public');
        } else {
            $photo = 'photo/default.png';
        }

        Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'material' => $request->material,
            'image' => $photo
        ]);
        return response()->json([
            "messenge" => "Успешно добавлено."
        ]);
    }

    public function deleteAdd(Request $request, string $id)
    {
        $product = Product::find($id);
        $user = $request->user();
        if ($user->role !== "admin" && $user->role !== "root") {
            return response()->json([
                "messenge" => "У вас нет прав"
            ]);
        }
        if (!$product) {
            return response()->json([
                "messenge" => "Не найдено"
            ]);
        }
        $product->delete();
        return response()->json([
            "messenge" => "Del"
        ]);
    }

    public function getProduct(Request $request) {
        return Product::all();
    }

    public function getProductCategory(Request $request, string $category) {
        $products = Product::where('category_id', $category)->get();
        return response()->json($products);
    }

}
