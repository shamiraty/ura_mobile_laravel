<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Branch;

class PostController extends Controller
{
    public function create()
    {
        $branches = Branch::all(); // Fetch branches to populate dropdown
        return view('administration.post', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:posts,name|max:100',
            'branch_id' => 'required|exists:branches,id',
        ]);

        try {
            Post::create([
                'name' => $request->name,
                'branch_id' => $request->branch_id,
                'registered_date_auto' => now(),
            ]);

            return redirect()->route('posts.create')->with('success', 'Post added successfully!');
        } catch (\Exception $e) {
            return redirect()->route('posts.create')->with('error', 'Error adding post: ' . $e->getMessage());
        }
    }
}
