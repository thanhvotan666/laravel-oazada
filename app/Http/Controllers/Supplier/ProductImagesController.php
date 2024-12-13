<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{

    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);
        $filePath = public_path($image->image);

        if (file_exists($filePath)) {
            unlink($filePath); // Xóa file khỏi hệ thống
        }

        $image->delete(); // Xóa bản ghi trong cơ sở dữ liệu

        return response()->json(['success' => true]);
    }
}
