<?php
namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Category\Models\Category;

class DataController extends Controller
{

    public function index($slug, Request $request)
    {
        $keyword = $request->keyword ?? '';  // Mengambil keyword dari URL query
        if (!is_string($keyword)) {
            $keyword = '';
        }
        $keyword = preg_replace('/[^a-zA-Z0-9 ]/', '', $keyword);

        // Ambil kategori berdasarkan slug
        $current_category = null;
        if ($slug !== 'all') {
            $current_category = Category::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        }

        // Ambil artikel berdasarkan kategori, jika ada
        $articles = Articles::where('category_id', $current_category ? $current_category->id : null)
            ->where('title', 'like', '%' . $keyword . '%')
            ->orderBy('id', 'DESC')
            ->paginate(12);  // 12 artikel per halaman

        // Proses PDF
        foreach ($articles as $article) {

            $pdfs = [];

            if (!empty($article->pdfs) && is_string($article->pdfs)) {
                // Hapus karakter escape jika ada
                $article->pdfs = str_replace('\\/', '/', $article->pdfs);

                // Decode JSON
                $decodedPdfs = json_decode($article->pdfs, true);

                // Jika decoding berhasil, gunakan hasilnya
                $pdfs = is_array($decodedPdfs) ? $decodedPdfs : [];
            }

            if (!empty($article->pdf)) {
                $pdfs[] = $article->pdf;
            }

            $article->pdfs = $pdfs; // Pastikan array
        }


        // Mengirim data ke view
        return view('pages.category.index', [
            'title' => $current_category ? $current_category->title : 'All Categories',
            'slug' => $slug,
            'keyword' => $keyword,
            'current_category' => $current_category,
            'articles' => $articles
        ]);
    }
    public function showSubcategory($slug, Request $request)
    {
        // Mengambil keyword dari URL query
        $keyword = $request->keyword ?? '';
        if (!is_string($keyword)) {
            $keyword = '';
        }
        $keyword = preg_replace('/[^a-zA-Z0-9 ]/', '', $keyword);

        // Cari subkategori berdasarkan slug (yang seharusnya diubah menjadi title)
        $subcategory = \App\Models\Subcategory::where('title', $slug)
            ->where('is_active', true)
            ->firstOrFail();  // Mencari subkategori berdasarkan title

        // Ambil artikel yang terkait dengan subkategori_id
        $articles = \App\Models\Articles::where('subcategory_id', $subcategory->id)
            ->where('title', 'like', '%' . $keyword . '%')
            ->orderBy('id', 'DESC')
            ->paginate(12);  // Menampilkan 12 artikel per halaman

        // Proses PDF (jika ada)
        foreach ($articles as $article) {
            $pdfs = [];

            if (!empty($article->pdfs) && is_string($article->pdfs)) {
                // Hapus karakter escape jika ada
                $article->pdfs = str_replace('\\/', '/', $article->pdfs);

                // Decode JSON
                $decodedPdfs = json_decode($article->pdfs, true);

                // Jika decoding berhasil, gunakan hasilnya
                $pdfs = is_array($decodedPdfs) ? $decodedPdfs : [];
            }

            if (!empty($article->pdf)) {
                $pdfs[] = $article->pdf;
            }

            $article->pdfs = $pdfs; // Pastikan array
        }

        // Mengirim data ke view
        return view('pages.category.index', [
            'title' => $subcategory->title,
            'slug' => $slug,
            'keyword' => $keyword,
            'subcategory' => $subcategory,
            'articles' => $articles
    ]);
}


}