<?php

namespace Karabin\FabriqPlugin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Karabin\Fabriq\Data\MenuData;
use Karabin\Fabriq\Fabriq;
use Karabin\Fabriq\Repositories\EloquentMenuRepository;
use Spatie\LaravelData\PaginatedDataCollection;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $eagerLoad = $this->getEagerLoad(Fabriq::getFqnModel('menu')::RELATIONSHIPS);
        $paginator = Fabriq::getFqnModel('menu')::with($eagerLoad)->paginate($request->number, 25);

        return MenuData::collect($paginator, PaginatedDataCollection::class);
    }

    public function show(Request $request, EloquentMenuRepository $menuRepo, string $slug)
    {
        $menu = $menuRepo->findBySlug($slug);

        return response()->json($menu);
    }
}
