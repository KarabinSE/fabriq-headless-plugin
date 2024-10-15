<?php

namespace Karabin\FabriqPlugin\Http\Controllers;

use Ikoncept\Fabriq\Fabriq;
use Ikoncept\Fabriq\Repositories\EloquentPageRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Infab\Core\Traits\ApiControllerTrait;

class PageController extends Controller
{
    use ApiControllerTrait;

    public function show(EloquentPageRepository $repo, Request $request, string $slug)
    {
        if ($request->has('preview')) {
            $url = base64_decode($request->preview);
            $data = Http::get($url);

            return $data->json();
        }

        $result = $repo->findBySlug($slug);

        return $this->respondWithItem($result, Fabriq::getTransformerFor('live_page'));
    }
}
