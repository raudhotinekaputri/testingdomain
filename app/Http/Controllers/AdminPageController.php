<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        Page::create([
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'content' => $request->content,
        ]);

        return redirect()->route('pages.index')->with('success', 'Halaman berhasil ditambahkan!');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $page->update([
            'title' => $request->title,
            'slug' => \Str::slug($request->title),
            'content' => $request->content,
        ]);

        return redirect()->route('pages.index')->with('success', 'Halaman berhasil diperbarui!');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Halaman berhasil dihapus!');
    }
}

