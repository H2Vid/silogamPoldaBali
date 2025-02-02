<?php

namespace App\Http\Controllers\CMS;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::all();
         // Kirim data ke view
    return view('cms.pages.subcategory.index', compact('subcategories'));
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

public function edit($id)
{
    // Ambil data subcategory berdasarkan ID
    $subcategory = Subcategory::findOrFail($id);  // Pastikan $id benar ada

    // Tampilkan halaman edit dengan membawa data subcategory
    return view('cms.pages.subcategory.crud', compact('subcategory'));  // Pastikan view yang dimaksud adalah 'crud.blade.php'
}

public function update(Request $request, $id)
{
    // Validasi input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1024',
        'is_active' => 'nullable|boolean',
    ]);

    // Cari subcategory berdasarkan ID
    $subcategory = Subcategory::findOrFail($id);

    // Update gambar jika ada
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($subcategory->image) {
            Storage::delete('public/' . $subcategory->image);
        }
        $imagePath = $request->file('image')->store('images/subcategories', 'public');
        $subcategory->image = $imagePath;
    }

    // Update data lainnya
    $subcategory->title = $request->input('title');
    $subcategory->description = $request->input('description');
    $subcategory->is_active = $request->input('is_active') ? true : false;
    $subcategory->save();

    // Redirect dengan pesan sukses
    return redirect()->route('cms.subcategory.index')->with('success', 'Subcategory berhasil diperbarui.');
}



// menghapus data subcategory
public function destroy($id)
{
    // Cari subcategory berdasarkan ID
    $subcategory = Subcategory::findOrFail($id);

    // Hapus gambar jika ada
    if ($subcategory->image) {
        Storage::delete('public/' . $subcategory->image);
    }

    // Hapus data subcategory dari database
    $subcategory->delete();

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('cms.subcategory.index')->with('success', 'Subcategory berhasil dihapus.');
}


}
