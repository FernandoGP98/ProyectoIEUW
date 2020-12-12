<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\comentario;
use App\Models\post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function AutorRegistrar(Request $request){

        $autor = new User();

        $autor->name = $request->name;
        $autor->email = $request->email;
        $autor->password = Hash::make($request->password);
        $autor->rol_id=2;

        $autor->profile_photo_path = "/images/user-image.png";

        if($autor->save()){
            return true;
        }else{
            return false;
        }
    }

    public function eliminarCuenta(){
        $delete = User::find(Auth::user()->id);
        comentario::where('user_id', $delete->id)->delete();
        like::where('user_id', $delete->id)->delete();
        post::where('user_id', $delete->id)->delete();
        Auth::logout();
        $delete->delete();
        return redirect('/');
    }
}
