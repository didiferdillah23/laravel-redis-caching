<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function getData()
    {
        $key = 'product_key';
    
        // Cek apakah data sudah ada di cache
        if (Cache::has($key)) {
            $data = Cache::get($key);
        } else {
            // Jika data belum ada di cache, ambil dari database atau sumber lain
            $data = Product::get();
            
            // Simpan data ke cache selama 5 menit
            Cache::put($key, $data, 60 * 5);
        }
        
        return $data;
    }
}
