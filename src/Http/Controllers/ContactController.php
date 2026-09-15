<?php

namespace Karabin\FabriqPlugin\Http\Controllers;

use Illuminate\Routing\Controller;
use Karabin\Fabriq\Data\ContactData;
use Karabin\Fabriq\Fabriq;
use Spatie\LaravelData\DataCollection;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Fabriq::getFqnModel('contact')::where('published', 1)
            ->orderBy('sortindex')
            ->get();

        return ContactData::collect($contacts, DataCollection::class);
    }

    public function show(int $id)
    {
        $contact = Fabriq::getFqnModel('contact')::where('id', $id)
            ->where('published', 1)
            ->firstOrFail();

        return ContactData::fromModel($contact);
    }
}
