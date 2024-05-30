<?php

namespace Karabin\FabriqPlugin\Http\Controllers;

use Ikoncept\Fabriq\Fabriq;
use Ikoncept\Fabriq\Repositories\EloquentMenuRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Infab\Core\Traits\ApiControllerTrait;

class MenuController extends Controller
{
    use ApiControllerTrait;

    public function index(Request $request): JsonResponse
    {
        $eagerLoad = $this->getEagerLoad(Fabriq::getFqnModel('menu')::RELATIONSHIPS);
        $paginator = Fabriq::getFqnModel('menu')::with($eagerLoad)->paginate($this->number);

        return $this->respondWithPaginator($paginator, Fabriq::getTransformerFor('menu'));
    }

    public function show(Request $request, EloquentMenuRepository $menuRepo, string $slug): JsonResponse
    {
        $menu = $menuRepo->findBySlug($slug);

        return $this->respondWithArray($menu);
    }
}
