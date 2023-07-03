<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Project;

class PostController extends Controller
{
    public function index(Request $request){
        if ($request->has('type_id')) {
		
            $posts = Project::with('type', 'technologies')->where('type_id', $request->type_id)->paginate(4);
        } else {
            $posts = Project::with('type', 'technologies')->paginate(4);
        }

    
        return response()->json([
        'success' => true,
        'posts' => $posts
        ]);
        }
        
}
