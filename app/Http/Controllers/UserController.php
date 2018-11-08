<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Users;


class UserController extends Controller
{
    public function detail(Request $request)
    {
        $selectWord = $request->input('select_word');
        $list = Users::where('name', 'like', '%' . $selectWord . '%')->orWhere('email', 'like', '%' . $selectWord . '%')->paginate(15);
        return response()->json($list);
    }

    public function update(Request $request)
    {
        $request->validate(['id' => 'required', 'name' => 'required', 'email' => 'required']);
        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        Users::where(['id' => $id])->update(['name' => $name, 'email' => $email]);
        return response()->json(['code' => 1, 'message' => 'success', 'data' => []]);
    }

    public function deleted(Request $request)
    {
        $request->validate(['id' => 'required']);
        $id = $request->input('id');
        Users::where(['id' => $id])->update(['deleted_at' => date('Y-m-d H:i:s')]);
        return response()->json(['code' => 1, 'message' => 'success', 'data' => []]);
    }

    public function addSave(Request $request)
    {
        $request->validate(['name' => 'required', 'email' => 'required']);
        $name = $request->input('name');
        $email = $request->input('email');
        $user = new Users;
        $user->name = $name;
        $user->email = $email;
        $user->password = 123456;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();
        return response()->json(['code' => 1, 'message' => 'success', 'data' => []]);
    }
}