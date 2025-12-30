<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class ArticleController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('permission:articles')->only(['index', 'edit', 'create', 'destroy']);
    } */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'DESC')
                          ->paginate(6);
        
        return view('articles.list', [
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'author' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:50',
            'status' => 'nullable|in:draft,published,archived',
            'tags' => 'nullable|string|max:500',
            'featured_image' => 'nullable|url|max:500',
        ]);

        // Set default author jika tidak diisi
        if (empty($validated['author'])) {
            $validated['author'] = Auth::user()->name;
        }

        // Set default status jika tidak diisi
        if (empty($validated['status'])) {
            $validated['status'] = 'draft';
        }

        // Create the article
        $article = Article::create($validated);

        return redirect()->route('articles.index')
            ->with('success', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        
        return view('articles.show', [
            'article' => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        
        return view('articles.edit', [
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'author' => 'required|string|max:100',
            'category' => 'nullable|string|max:50',
            'status' => 'required|in:draft,published,archived',
            'tags' => 'nullable|string|max:500',
            'featured_image' => 'nullable|url|max:500',
        ]);

        $article->update($validated);

        return redirect()->route('articles.index')
            ->with('success', 'Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully.');
    }

    /**
     * Get articles by status
     */
    public function byStatus($status)
    {
        $validStatuses = ['draft', 'published', 'archived'];
        
        if (!in_array($status, $validStatuses)) {
            abort(404);
        }

        $articles = Article::where('status', $status)
                          ->orderBy('created_at', 'DESC')
                          ->paginate(10);

        return view('articles.index', [
            'articles' => $articles,
            'status' => $status
        ]);
    }

    /**
     * Get articles by category
     */
    public function byCategory($category)
    {
        $articles = Article::where('category', $category)
                          ->orderBy('created_at', 'DESC')
                          ->paginate(10);

        return view('articles.index', [
            'articles' => $articles,
            'category' => $category
        ]);
    }

    /**
     * Search articles
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $articles = Article::where('title', 'LIKE', "%{$query}%")
                          ->orWhere('content', 'LIKE', "%{$query}%")
                          ->orWhere('author', 'LIKE', "%{$query}%")
                          ->orWhere('tags', 'LIKE', "%{$query}%")
                          ->orderBy('created_at', 'DESC')
                          ->paginate(10);

        return view('articles.index', [
            'articles' => $articles,
            'search_query' => $query
        ]);
    }
}