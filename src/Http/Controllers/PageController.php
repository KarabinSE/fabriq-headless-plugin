<?php

namespace Karabin\FabriqPlugin\Http\Controllers;

use Ikoncept\Fabriq\Fabriq;
use Ikoncept\Fabriq\Repositories\EloquentPageRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Infab\Core\Traits\ApiControllerTrait;

class PageController extends Controller
{
    use ApiControllerTrait;

    public function show(EloquentPageRepository $repo, Request $request, string $slug): JsonResponse
    {
        $result = $repo->findBySlug($slug);

        return $this->respondWithItem($result, Fabriq::getTransformerFor('live_page'));
    }
}
