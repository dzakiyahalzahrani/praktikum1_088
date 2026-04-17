<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function update(User $user, Product $product): bool
    {
        // Berikan izin JIKA user adalah admin, ATAU JIKA user adalah pemilik produk tersebut
        return $user->role === 'admin' || $user->id === $product->user_id;
    }

    public function delete(User $user, Product $product): bool
    {
        // Sama dengan fungsi update
        return $user->role === 'admin' || $user->id === $product->user_id;
    }
}