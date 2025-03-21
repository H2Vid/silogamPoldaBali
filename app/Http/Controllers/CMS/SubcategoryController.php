<?php

namespace App\Http\Controllers\CMS;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Modules\Category\Models\Category;

class SubcategoryController extends Controller
{



    public function index(Request $request)
    {
        // Membangun query untuk subcategory
        $query = Subcategory::query();

        // Jika ada parameter 'search' pada request, lakukan pencarian
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Tentukan jumlah data per halaman (default 5)
        $perPage = $request->input('per_page', 5); // default 5

        // Ambil data subcategory dengan pagination
        $subcategories = $query->paginate($perPage);

        // Kembalikan ke view dengan data subcategories
        return view('cms.pages.subcategory.index', compact('subcategories'));
    }
            public function crud()
            {
                // Ambil semua kategori dari database
                $categories = Category::all();  // Pastikan Anda memiliki model Category dan tabel categories

                // Menampilkan halaman create (crud) dan mengirimkan data kategori
                return view('cms.pages.subcategory.crud', compact('categories'));
            }




    public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|integer',
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
    $subcategory->category_id = $request->input('category_id');
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
   // Ambil semua kategori dari database
   $categories = Category::all();  // Ambil data kategori untuk dropdown
    // Tampilkan halaman edit dengan membawa data subcategory
    return view('cms.pages.subcategory.crud', compact('subcategory','categories'));  // Pastikan view yang dimaksud adalah 'crud.blade.php'
}

public function update(Request $request, $id)
{
    // Validasi input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|integer',
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
    $subcategory->category_id = $request->input('category_id');
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
