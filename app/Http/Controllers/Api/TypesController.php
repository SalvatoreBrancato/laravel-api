<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Type;

class TypesController extends Controller
{
        public function index(){
        $types = Type::all();
        return response()->json(
            [
                'success' => true,
                'types' => $types
            ]
        );
    }
}
