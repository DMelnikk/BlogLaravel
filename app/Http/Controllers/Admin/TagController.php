<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::query()->paginate();
        return view('admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
           'title'=>['required','max:255'],
           'meta_desc'=>['max:255']
        ]);

        $res =  Tag::query()->create($validated);
        return redirect()->route('tags.index')->with('success','Tag added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::query()->findOrFail($id);
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tag = Tag::query()->findOrFail($id);

        $validated = request()->validate([
            'title'=>['required','max:255'],
            'meta_desc'=>['max:255']
        ]);

        $tag->update($validated);
        return redirect()->route('tags.index')->with('success','Tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::query()->findOrFail($id);
        // если есть связанные записи , то-есть у тэгов есть посты
        if($tag->posts()->count() > 0){
            return redirect()->route('tags.index')->with('error',' This tag has posts');
        }
        $tag->delete();
        return redirect()->route('tags.index')->with('success','Tag deleted successfully');
    }
}
