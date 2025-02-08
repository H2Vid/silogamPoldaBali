<?php
namespace App\Http\Controllers;

use App\Models\Articles;
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

        // Mengirim data ke view
        return view('pages.category.index', [
            'title' => $current_category ? $current_category->title : 'All Categories',
            'slug' => $slug,
            'keyword' => $keyword,
            'current_category' => $current_category,
            'articles' => $articles
        ]);
    }
}
