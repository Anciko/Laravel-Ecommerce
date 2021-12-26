<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    public function login(Request $request) {
        $input = $request->only(['email','password']);
        $jwt_token = JWTAuth::attempt($input);
        if($jwt_token) {
            return response()->json([
                "con" => true,
                "msg" => "Success",
                "token" => $jwt_token
            ]);
        }else {
            return response()->json([
                "con" => false,
                "msg" => "Fail"
            ]);
        }
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits_between:7,11',
            'password' => 'required',
            'password2' => 'required|same:password'
        ]);
        if($validator->fails()) {
            return response()->json([
                'con' => false,
                'msg' => 'Data Error'
            ]);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'con' => 'success',
            'msg' => 'Register success, please login Sir!'
        ]);
    }

    public function getAllCats() {
        $cats = Category::all();
        return response()->json([
            "con" => true,
            "msg" => "All Categories",
            "cats" => $cats
        ]);
    }

    public function getSubcats($id) {
        $subcats = SubCat::where('category_id', $id)->get();
        return response()->json([
            "con" => true,
            "msg" => "All Sub Categories",
            "subcats" => $subcats
        ]);
    }

    public function me() {
        return response()->json([
            "con" => true,
            "msg" => "Success",
            "user" => auth()->user()->name
        ]);
    }
}
