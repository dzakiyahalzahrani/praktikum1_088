<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; // Import Model Product
use Illuminate\Support\Facades\Log; // Import Log
use Illuminate\Support\Facades\Auth; // Import Auth

// Jika kamu punya file FormRequest khusus, jangan lupa di-import juga:
// use App\Http\Requests\StoreProductRequest; 

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get(); 
        
        return response()->json([
            'message' => 'Berhasil mengambil semua data produk',
            'data' => $products
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    // Catatan: Jika StoreProductRequest belum dibuat, ganti dengan Request
    public function store(Request $request) 
    {
        try {
            // 1. UBAH NAMA KOLOM MENJADI categories_id
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'categories_id' => 'required|exists:categories,id', 
                'price' => 'required|numeric',
                'quantity' => 'required|integer'
            ]);

            $validated['user_id'] = Auth::id();

            $product = Product::create($validated);

            Log::info('Menambah data produk', [
                'list' => $product
            ]);

            return response()->json([
                'message' => 'Produk berhasil ditambahkan!!',
                'data' => $product,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // 2. TANGKAP ERROR VALIDASI (Misal ada kolom kosong/salah nama)
            return response()->json([
                'message' => 'Data tidak valid',
                'errors' => $e->errors()
            ], 422);

        } catch (\Throwable $e) {
            // 3. MUNCULKAN ERROR ASLI JIKA DATABASE CRASH
            Log::error('Error saat menambah product', [
                'message' => $e->getMessage(),
            ]);
            return response()->json([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage() // Menampilkan pesan asli ke Scramble
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $product = Product::with('category')->find($id);

            if (!$product)
            {
                return response()->json([
                    'message' => 'Product tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'message' => 'Product retrieved successfully',
                'data' => $product
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data produk', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    } // <--- KURUNG KURAWAL INI YANG SEBELUMNYA HILANG

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric',
                'quantity' => 'required|integer'
            ]);

            $product->update($validated);

            return response()->json([
                'message' => 'Produk berhasil diupdate!',
                'data' => $product,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat update produk', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }

            $product->delete();

            return response()->json([
                'message' => 'Produk berhasil dihapus!'
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat menghapus produk', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
}