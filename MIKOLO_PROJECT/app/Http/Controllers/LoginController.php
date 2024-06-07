<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //
    public  function acceuil()
    {
        $l = \App\Models\Laptop::affichageLaptop();
        return view('acceuilAdmin.accAdmin',compact('l'));
    }
    public  function  traitLogin(Request $request)
    {
        $n = $request->input('name');
        $m = $request->input('mdp');
         $res = Login::checkM($n,$m);
         if($res)
         {
            session()->put('admin',$res);
//            dd(session('admin'));

             $l = \App\Models\Laptop::affichageLaptop();
            return view('acceuilAdmin.accAdmin',compact('l'));
         }
         return redirect()->back()->with('inconito','verifier les input');
    }
    public  function traitLoginpv(Request $request)
    {
        $pv = $request->input('pv');
        $res = DB::select("select * from pv where id = ?",[$pv]);
        if ($res)
        {
            session()->put('pv',$res);
            $recus = DB::select(" select * from  v_stock_lap_pv where idpv = ?",[session('pv')[0]->id]);
            return view('acceuil.acc',compact('recus'));
        }
    }
    public  function  logout()
    {
        session()->forget('admin');
         $admin = Login::all();
        return view('Login.login',compact('admin'));
    }
}
