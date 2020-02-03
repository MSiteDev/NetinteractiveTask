<?php

namespace App\Http\Controllers;

use App\Model\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::query()->withCount("users")->get();

        return view("languages.list", [
            "languages" => $languages
        ]);
    }
}
