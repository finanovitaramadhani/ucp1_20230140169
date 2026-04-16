<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Semua user boleh lihat list produk
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Semua user boleh lihat detail produk
     */
    public function view(User $user, Product $product): bool
    {
        return true;
    }

    /**
     * Semua user boleh membuat produk
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Hanya admin yang bisa edit produk miliknya sendiri
     */
    public function update(User $user, Product $product): bool
    {
        return $user->role === 'admin' && $user->id === $product->user_id;
    }

    /**
     * Hanya admin yang bisa hapus produk miliknya sendiri
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->role === 'admin' && $user->id === $product->user_id;
    }

    public function restore(User $user, Product $product): bool
    {
        return false;
    }

    public function forceDelete(User $user, Product $product): bool
    {
        return false;
    }
}