<?php

namespace App\Http\Controllers\CMS;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubcategoryController extends Controller
{
    public function index()
    {
        return view('cms.pages.subcategory.index');
    }
    public function crud()
    {
        // Menampilkan halaman create (crud)
        return view('cms.pages.subcategory.crud');
    }

    public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1024',
        'is_active' => 'nullable|boolean',
    ]);

    // Menyimpan gambar jika ada
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images/subcategories', 'public');
    }

    // Simpan data ke database
    $subcategory = new Subcategory();
    $subcategory->title = $request->input('title');
    $subcategory->description = $request->input('description');
    $subcategory->image = $imagePath; // Menyimpan path gambar
    $subcategory->is_active = $request->input('is_active') ? true : false;
    $subcategory->save();

    // Redirect dengan pesan sukses
    return redirect()->route('cms.subcategory.index')->with('success', 'Subcategory berhasil ditambahkan.');
}



}
