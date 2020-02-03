<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Model\Language;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::query()->latest();

        if(in_array((int)$request->get("days"), [3, 7, 30]))
            $users->whereDate("created_at", ">", Carbon::now()->subDays($request->get("days")));

        return view("users.list", [
            "users" => $users->paginate()
        ]);
    }

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
