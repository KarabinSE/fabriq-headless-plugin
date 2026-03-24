<?php

namespace Karabin\FabriqPlugin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Karabin\Fabriq\Data\ArticleData;
use Karabin\Fabriq\Fabriq;
use Spatie\LaravelData\PaginatedDataCollection;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $articles = Fabriq::getFqnModel('article')::published()->paginate($request->input('number', 25));

        return ArticleData::collect($articles, PaginatedDataCollection::class);
    }

    public function show(string $slug)
    {
        $article = Fabriq::getFqnModel('article')::published()
            ->whereHas('slugs', function ($query) use ($slug) {
                return $query->where('slug', $slug);
            })
            ->firstOrFail();

        return ArticleData::fromModel($article);
    }
}
