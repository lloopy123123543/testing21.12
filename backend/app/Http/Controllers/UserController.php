<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function show_users()
    {
        $show = User::all();
        return response()->json($show);
    }


    public function registration(Request $request)
    {
        $add = new User();
        $add->login = $request->input("login");
        $add->password = $request->input("password");
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        $add->token = $token;
        $add->save();
        return response()->json(["token" => $token]);

    }

    public function editUser(Request $request){
        $edit = User::all() -> where("id", $request->input("id")) -> first();
        $edit -> login = $request->input("login");
        $edit -> save();

        return response()->json($edit);
    }

    public function deleteUser($id){
        $delete = User::find($id);
        $delete -> delete();
        return response()->json("success");

    }


}

