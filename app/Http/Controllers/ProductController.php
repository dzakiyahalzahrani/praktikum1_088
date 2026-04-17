<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        // Ubah dari all() menjadi paginate()
        $products = Product::latest()->paginate(10);
        return view('product.index', compact('products'));
    }

    
    public function store(Request $request)
    {
        $isAdmin = auth()->user()->role === 'admin';

        // Array pesan error kustom dari modul
        $customMessages = [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'quantity.required' => 'Jumlah (kuantitas) produk wajib diisi.',
            'quantity.integer' => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka yang valid.',
        ];

        if ($isAdmin) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'quantity' => 'required|integer',
                'price' => 'required|numeric',
                'user_id' => 'required|exists:users,id',
                'categories_id' => 'required|exists:categories,id',
            ], $customMessages);
        } else {
            // User biasa
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'quantity' => 'required|integer',
                'price' => 'required|numeric',
            ], $customMessages);
            
            $validated['user_id'] = auth()->id();
            $validated['categories_id'] = Category::firstOrCreate(['name' => 'Uncategorized'])->id;
        }

        Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function create()
    {
        $isAdmin = auth()->user()->role === 'admin';
        $users = $isAdmin ? User::orderBy('name')->get() : collect();
        $categories = $isAdmin ? Category::orderBy('name')->get() : collect();

        return view('product.create', compact('users', 'categories', 'isAdmin'));
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        
        $isAdmin = auth()->user()->role === 'admin';
        $users = $isAdmin ? User::orderBy('name')->get() : collect();
        $categories = $isAdmin ? Category::orderBy('name')->get() : collect();

        return view('product.edit', compact('product', 'users', 'categories', 'isAdmin'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);

        $isAdmin = auth()->user()->role === 'admin';

        // Array pesan error kustom dari modul
        $customMessages = [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'quantity.required' => 'Jumlah (kuantitas) produk wajib diisi.',
            'quantity.integer' => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka yang valid.',
        ];

        if ($isAdmin) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'quantity' => 'required|integer',
                'price' => 'required|numeric',
                'user_id' => 'required|exists:users,id',
                'categories_id' => 'required|exists:categories,id',
            ], $customMessages);
        } else {
            // User biasa
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'quantity' => 'required|integer',
                'price' => 'required|numeric',
            ], $customMessages);
            
            $validated['user_id'] = $product->user_id;
            $validated['categories_id'] = $product->categories_id;
        }

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

   public function delete($id)
    {
        // 1. Cari produknya dulu
        $product = Product::findOrFail($id);

        // 2. PASANG GEMBOKNYA DI SINI
        $this->authorize('delete', $product);

        $product->delete();

        return back()->with('success', 'Product berhasil dihapus');
    }

    // Tambahkan method ini jika Anda ingin menjalankan instruksi export Gate
    public function export()
    {
        // Cek Gate secara manual di Controller
        if (\Illuminate\Support\Facades\Gate::denies('export-product')) {
            abort(403, 'Hanya Admin yang bisa export data.');
        }

        // Logika export Anda di sini...
        return response()->json(['message' => 'Proses export dimulai...']);
    }
}