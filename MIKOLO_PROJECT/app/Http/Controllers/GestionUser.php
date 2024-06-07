<?php

namespace App\Http\Controllers;

use App\Models\Pv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class GestionUser extends Controller
{
    //
    public  function  detailpv($id)
    {
        $res  = DB::select("SELECT * FROM pv where id = ?",[$id]);
        if ($res)
        {
            $res = $res[0];
        }
//        dd($res);
        return view('pv.detail',compact('res'));
    }
    public  function traitT(Request $request)
    {
        $idSend =  $request->input('idsend');
        $nbruserSend = Pv::getUserById($idSend);
        $idreceive =  $request->input('idreceive');
        $nbr =  $request->input('nbr');
//        dd($nbr,$nbruserSend->nbruser);
        if ($nbruserSend->nbruser < $nbr)
        {
            return redirect()->back()->with('sup','le nombre  user est insuffisant');
        }
       else
       {
           DB::beginTransaction();
           try
           {
               Pv::updatesend($idSend,$nbr);
               Pv::updatereceive($idreceive,$nbr);
               DB::commit();
               return redirect()->back();
           }
           catch (Exception $ex)
           {
               DB::rollBack();
               return redirect()->back()->with('ex', $ex->getMessage());
           }

       }

    }
}
