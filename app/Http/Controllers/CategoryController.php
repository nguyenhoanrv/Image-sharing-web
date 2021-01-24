<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    public function getCategories() {
        $categories = Category::get();
        return $categories;
    }
    
}