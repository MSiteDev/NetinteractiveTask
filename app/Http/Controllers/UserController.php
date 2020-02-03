<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Model\Language;
use App\Model\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function show(User $user)
    {
        return view("users.show", [
            "user" => $user->load("languages")
        ]);
    }

    public function showForm()
    {
        return view("users.form");
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User($request->only([
            "first_name",
            "last_name",
            "email",
            "pesel"
        ]));

        $user->save();


        $languages = new Collection;

        foreach($request->get("languages") as $language)
            $languages->add(Language::firstOrCreate(["name" => $language]));

        $user->languages()->sync($languages);

        return redirect()->action([self::class, "show"], $user);
    }
}
