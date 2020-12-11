<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class usuario extends Controller
{
    public function UsuarioUpdate(Request $request){
        //return $request->hasFile('foto');
        $usuario = Auth::user();
        $usuario->name = $request->name;
        $usuario->email = $request->email;

        if($request->password!=null){
            $usuario->password = Hash::make($request->password);
        }
        if($request->hasFile('foto')){
            $imgName = time().'.'.$request->foto->getClientOriginalExtension();
            $request->foto->move('images/', $imgName);
            $rute='/images/'.$imgName;

            $usuario->profile_photo_path = $rute;
        }
        if($usuario->save()){
            Auth::user()->name = $usuario->name;
            Auth::user()->email = $usuario->email;
            Auth::user()->password = $usuario->password;
            Auth::user()->profile_photo_path = $usuario->profile_photo_path;
            return redirect()->back()->with('toastr', 1);
        }else{
            return "error";
        }
        return "error";
    }
}
