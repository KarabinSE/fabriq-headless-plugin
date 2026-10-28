<?php

namespace Karabin\FabriqPlugin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Karabin\Fabriq\ContentGetters\ContentResourceContext;
use Karabin\Fabriq\Fabriq;
use Karabin\Fabriq\Repositories\EloquentPageRepository;

class PageController extends Controller
{
    public function show(EloquentPageRepository $repo, Request $request, string $slug)
    {
        if ($request->has('preview')) {
            $url = base64_decode($request->preview);
            $data = Http::get($url);

            return $data->json();
        }

        $result = $repo->findBySlug($slug);

        return ContentResourceContext::withModels([$result], function () use ($result, $request) {
            $result->content = $result->getFieldContent(app()->getLocale())->except('boxes');

            return Fabriq::getDto('live_page')::fromModel($result)
                ->wrap('data')
                ->toResponse($request);
        });
    }
}
