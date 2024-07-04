<?php

namespace Karabin\FabriqPlugin\Http\Controllers;

use Ikoncept\Fabriq\Fabriq;
use Illuminate\Routing\Controller;
use Infab\Core\Traits\ApiControllerTrait;

class NewsController extends Controller
{
    use ApiControllerTrait;

    public function index()
    {
        $articles = Fabriq::getFqnModel('article')::published()->paginate($this->number);

        return $this->respondWithPaginator($articles, Fabriq::getTransformerFor('article'));
    }

    public function show(int $id)
    {
        $article = Fabriq::getFqnModel('article')::published()
            ->whereId($id)
            ->firstOrFail();

        return $this->respondWithItem($article, Fabriq::getTransformerFor('article'));
    }
}
