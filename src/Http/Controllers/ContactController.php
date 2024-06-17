<?php

namespace Karabin\FabriqPlugin\Http\Controllers;

use Ikoncept\Fabriq\Fabriq;
use Illuminate\Routing\Controller;
use Infab\Core\Traits\ApiControllerTrait;

class ContactController extends Controller
{
    use ApiControllerTrait;

    public function index()
    {
        $contacts = Fabriq::getFqnModel('contact')::where('published', 1)
            ->orderBy('sortindex')
            ->get();

        return $this->respondWithCollection($contacts, Fabriq::getTransformerFor('contact'));
    }

    public function show(int $id)
    {
        $contact = Fabriq::getFqnModel('contact')::where('id', $id)
            ->where('published', 1)
            ->firstOrFail();

        return $this->respondWithItem($contact, Fabriq::getTransformerFor('contact'));
    }
}
