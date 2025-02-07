<?php

namespace App\Http\Controllers\CMS;
use App\Models\Articles;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Category\Models\Category;

class ArticlesController extends Controller
{
    public function index(Request $request)
    {
        // Membangun query untuk artikel
        $query = Articles::query();

        // Pencarian berdasarkan title dan excerpt
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
        }

        // Tentukan jumlah data per halaman (default 5)
        $perPage = $request->input('per_page', 5); // default 5

        // Ambil data artikel dengan pagination
        $articles = $query->paginate($perPage);

        // Kembalikan ke view dengan data artikel
        return view('cms.pages.articles.index', compact('articles'));
    }
    public function crud()
    {
        // Ambil data kategori
        $categories = Category::all(); // Mendapatkan semua kategori
        $subcategories = Subcategory::all(); // Mendapatkan semua subkategori

        // Kirim data kategori dan subkategori ke view
        return view('cms.pages.articles.crud', compact('categories', 'subcategories'));
    }


    public function save(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug',
            'excerpt' => 'nullable|string|max:300',
            'description' => 'nullable|string',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'is_active' => 'required|boolean',
            'is_limited' => 'required|boolean',
            'pdfs' => 'nullable|array',
            'pdfs.*' => 'mimes:pdf|max:10240', // Maksimal 10MB untuk setiap file PDF
        ]);


        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/articles', 'public');
        }
        // Menyimpan file PDF jika ada
        if ($request->hasFile('pdfs')) {
            $pdfPaths = [];
            foreach ($request->file('pdfs') as $pdf) {
                $pdfPaths[] = $pdf->store('public/pdfs');
            }
            $article->pdfs = json_encode($pdfPaths); // Menyimpan file PDF dalam format JSON array
        }

        // Menyimpan data artikel baru
        $article = new Articles();
        $article->title = $validated['title'];
        $article->slug = $validated['slug'];
        $article->excerpt = $validated['excerpt'];
        $article->description = $validated['description'];
        $article->category_id = $validated['category_id'];
        $article->subcategory_id = $validated['subcategory_id'];
        $article->is_active = $validated['is_active'];
        $article->is_limited = $validated['is_limited'];
        $article->image = $imagePath; // Menyimpan path gambar

        // Simpan artikel ke database
        $article->save();

        // Redirect ke halaman yang sesuai setelah berhasil menyimpan
        return redirect()->route('cms.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }


}
