<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use App\Models\Processeur;
use App\Models\Pv;
use App\Models\Stock;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;

class laptop extends Controller
{
    //
    public  function pageAddLaptop()
    {
        $m = Marque::all();
        $p = Processeur::all();
        return view('laptop.add',compact('m','p'));
    }
    public  function  traitlap(Request $request)
    {
        $l = new \App\Models\Laptop();
        $l->marque_id = $request->input('marque');
        $l->modele = $request->input('modele');
        $l->processeur_id = $request->input('proc');
        $l->ram= $request->input('ram');
        $l->ecran = $request->input('ecran');
        $l->disque_dur = $request->input('dur');
        $l->prix = $request->input('prix');
        $l->save();
        return redirect()->back();
    }
    public  function deleteLap(Request $request)
    {
        $id = $request->input('id');
        \App\Models\Laptop::deletelap($id);
        return redirect()->back();
    }
    public  function modifLap($id)
    {

        $m = Marque::all();
        $p = Processeur::all();
        $res = \App\Models\Laptop::mLaptop($id);
        return view('laptop.modif',compact('res','m','p'));
    }
    public  function traitmodiflap(Request $request)
    {
        $idlap = $request->input('idlap');
        $marque_id = $request->input('marque');
        $modele = $request->input('modele');
        $processeur_id = $request->input('proc');
        $ram= $request->input('ram');
        $ecran = $request->input('ecran');
        $disque_dur = $request->input('dur');
        \App\Models\Laptop::updateLap($marque_id,$modele,$processeur_id,$ram,$ecran,$disque_dur,$idlap);
        return redirect()->back();
    }
//    marques
    public  function  marque()
    {
        $res = Marque::all();
        return view('marque.all',compact('res')) ;
    }
    public  function modifm($id)
    {
        $res = Marque::getById($id);
        return view('marque.modif',compact('res'));
    }
    public  function traitmodifm(Request $request)
    {
        $idm = $request->input('idm');
        $marque = $request->input('nom');
        Marque::updatem($idm,$marque);
        return redirect()->back();
    }
    public  function deletem(Request $request)
    {
        $id = $request->input('id');
        Marque::deletem($id);
        return redirect()->back();
    }
    public  function  pageAddm()
    {
        return view('marque.add');
    }
    public  function  traitm(Request $request)
    {
        $l = new Marque();
        $l->nom = $request->input('marque');
        $l->save();
        return redirect()->back();
    }
//    proc
    public  function  proc()
    {
        $res = Processeur::all();
        return view('processeur.all',compact('res')) ;
    }
    public  function modifp($id)
    {
        $res = Processeur::getById($id);
        return view('processeur.modif',compact('res'));
    }
    public  function traitmodifp(Request $request)
    {
        $idm = $request->input('idm');
        $marque = $request->input('nom');
        Processeur::updatem($idm,$marque);
        return redirect()->back();
    }
    public  function deletep(Request $request)
    {
        $id = $request->input('id');
        Processeur::deletem($id);
        return redirect()->back();
    }
    public  function  pageAddp()
    {
        return view('processeur.add');
    }
    public  function  traitp(Request $request)
    {
        $l = new Processeur();
        $l->nom = $request->input('marque');
        $l->save();
        return redirect()->back();
    }
    //    proc
    public  function  pv()
    {
        $res = Pv::getAll();
        return view('pv.all',compact('res')) ;
    }
    public  function pageAddpv()
    {
        return view('pv.add');
    }
    public  function traitpv(Request $request)
    {
        $pv = new Pv();
        $pv->nom = $request->input('nom') ;
        $pv->latitude = $request->input('lat');
        $pv->longitude = $request->input('long');
        $pv->nbruser = $request->input('user');
        $pv->save();
        return redirect()->back();
    }
    public function traitpvmap(Request $request)
    {
        $latitudes = $request->input('latitude');
        $longitudes = $request->input('longitude');
        $names = $request->input('nom');
        $userCounts = $request->input('nbruser');
//        dd($userCounts);
        $numberOfMarkers = count($latitudes);
        for ($i = 0; $i < $numberOfMarkers; $i++) {
            $pv = new Pv();
            $pv->nom = $names[$i];
            $pv->latitude = $latitudes[$i];
            $pv->longitude = $longitudes[$i];
            $pv->nbruser = $userCounts[$i];
            $pv->save();
        }
        return redirect()->back();
    }
    public  function deletepv(Request $request)
    {
        $id = $request->input('id');
        Pv::deletepv($id);
        return redirect()->back();
    }
    public  function modifpv($id)
    {
        $res = Pv::getById($id);
        return view('pv.modif',compact('res'));
    }
    public  function traitmodifpv(Request $request)
    {
        $idpv = $request->input('idpv');
        $nbruser = $request->input('nbruser');
        $nom = $request->input('nom');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        Pv::updatepv($nbruser,$nom,$latitude,$longitude,$idpv);
        return redirect()->back();
    }
    public  function  achatLaptop()
    {
        $res = \App\Models\Laptop::all();
        return view('Stock.all',compact('res'));
    }
//    achat
    public  function  traitAchat(Request $request)
    {
        $idlap = $request->input('lap');
        $nbr = $request->input('nbr');
        \App\Models\Laptop::achat($idlap,$nbr);
        return redirect()->back();
    }
    public  function TransfertLaptop()
    {
        $res = DB::select("select * from pv");
        $lap = DB::select("select * from laptops");
        return view('laptop.transfert',compact('res','lap'));
    }
    public  function  traitTransfertLap(Request $request)
    {
        $pv = $request->input('pv');
        $lap = $request->input('lap');
        $nbr = $request->input('nbr');
        $nbrstock  =  Stock::getStockBy_Lap( $pv,$lap);
         if ($nbrstock>$nbr)
         {
//             anasorana nbr le reception (stock)
             DB::beginTransaction();

             try {
                 Stock::transfertLap_pv($pv,$lap,$nbr);
//                 sortie au cas ou
                 $quantityToRemove = $nbr;
                 // Lifo
                 $stocks = DB::select("SELECT id, nbr FROM stockM WHERE idlaptop = ? ORDER BY id DESC", [$lap]);
                 foreach ($stocks as $stock) {
                     if ($quantityToRemove <= 0) {
                         break;
                     }
                     if ($stock->nbr >= $quantityToRemove) {
                         DB::update("UPDATE stockM SET nbr = nbr - ? WHERE id = ?", [$quantityToRemove, $stock->id]);
                         $quantityToRemove = 0;
                     } else {
                         $quantityToRemove =$quantityToRemove-$stock->nbr;
                         DB::update("UPDATE stockM SET nbr = 0 WHERE id = ?", [$stock->id]);
                     }
                 }
                 DB::commit();
                 return  redirect()->back();
             } catch (Exception $ex) {
                 DB::rollBack();
                 return  redirect()->back()->with('diso' ,$ex->getMessage());
             }
         }
         else{
             return  redirect()->back()->with('sup','stock insuffisant');
         }


    }
    public  function  validationRecus(Request $request)
    {
        $idpv = session('pv')[0]->id;
        $lap = $request->input('lap');
        $nbr = $request->input('nbr');
        \App\Models\Laptop::insert_reception($idpv,$lap,$nbr);
//insert_Perte
       $m_envoyer =  DB::select("select * from  stock_lap_pv where idpv  =? and idlap = ?",[$idpv,$lap]);
       $reception =  DB::select("select * from  receptionlap where idpv  =? and idlap = ?",[$idpv,$lap]);
       $magasin =$m_envoyer[0]->nb;
       $receptions = $reception[0]->nbr;
       $perte = $magasin - $receptions;
       \App\Models\Laptop::perte($idpv,$lap,$perte);
        return  redirect('profilpv');
    }
    public  function  renvoi(Request $request)
    {
        $pv =session('pv')[0]->id;
        $lap = $request->input('lap');
        $nbr = $request->input('nbr');
        $nbrstock  =  Stock::getStockBy_Lap_pv($pv,$lap);
//        dd($nbrstock);
        if ($nbrstock>$nbr)
        {
            DB::beginTransaction();
            try {
                Stock::transfertLap_mag($lap,$nbr);
                $quantityToRemove = $nbr;
                // Lifo
                $stocks = DB::select("SELECT * FROM receptionlap WHERE idlap = ? and idpv = ?  order by id desc", [$lap,$pv]);
                foreach ($stocks as $stock) {
                    if ($quantityToRemove <= 0) {
                        break;
                    }
                    if ($stock->nbr >= $quantityToRemove) {
                        DB::update("UPDATE receptionlap SET nbr = nbr - ? WHERE id = ?", [$quantityToRemove, $stock->id]);
                        $quantityToRemove = 0;
                    } else {
                        // Soustraire toute la quantité et continuer
                        $quantityToRemove =$quantityToRemove-$stock->nbr;
                        DB::update("UPDATE receptionlap SET nbr = 0 WHERE id = ?", [$stock->id]);
                    }
                }
                DB::commit();
                return  redirect()->back();
            } catch (Exception $ex) {
                DB::rollBack();
                return  redirect()->back()->with('diso' ,$ex->getMessage());
            }
        }
        else{
            return  redirect()->back()->with('sup','stock insuffisant');
        }

    }
    public  function  ventes()
    {
        $res = \App\Models\Laptop::all();
        return view('laptop.vente',compact('res'));
    }
    public  function  traitventes(Request $request)
    {
        $lap = $request->input('lap');
        $pv = session('pv')[0]->id;
        $nbr = $request->input('nbr');
        $nbrstock  =  Stock::getStockBy_Lap_pv($pv,$lap);
       if ($nbrstock>$nbr)
       {
        \App\Models\Laptop::insertVentes($lap,$pv,$nbr);
           DB::beginTransaction();
           try {
               $quantityToRemove = $nbr;
               // Lifo
               $stocks = DB::select("SELECT * FROM receptionlap WHERE idlap = ? and idpv = ?  order by id desc", [$lap,$pv]);
               foreach ($stocks as $stock) {
                   if ($quantityToRemove <= 0) {
                       break;
                   }
                   if ($stock->nbr >= $quantityToRemove) {
                       DB::update("UPDATE receptionlap SET nbr = nbr - ? WHERE id = ?", [$quantityToRemove, $stock->id]);
                       $quantityToRemove = 0;
                   } else {
                       $quantityToRemove =$quantityToRemove-$stock->nbr;
                       DB::update("UPDATE receptionlap SET nbr = 0 WHERE id = ?", [$stock->id]);
                   }
               }
               DB::commit();
               return  redirect()->back();
           } catch (Exception $ex) {
               DB::rollBack();
               return redirect()->back()->with('diso', $ex->getMessage());
           }
       }
       else{
           return  redirect()->back()->with('sup','stock insuffisant');
       }
    }
    public  function  Stat()
    {
        $res = DB::select("select  EXTRACT(YEAR FROM date_vente) AS year from vente group by year  ");
        return view('stat.stat',compact('res'));
    }
    public function traitstat(Request $request)
    {
        $res = DB::select("select  EXTRACT(YEAR FROM date_vente) AS year from vente group by year  ");
        $annee  =$request->input('date');
       $ress =  \App\Models\Laptop::get_chiffre_affaire_mois($annee);
//       dd($ress);
        Session::put('res',$ress);
        return view('stat.stat',compact('ress','res'));
    }
    public function histo($annee)
    {
//        dd($annee);
        $ress =  \App\Models\Laptop::get_chiffre_affaire_mois($annee);
        $months = [
            'January' => 0, 'February' => 0, 'March' => 0, 'April' => 0,
            'May' => 0, 'June' => 0, 'July' => 0, 'August' => 0,
            'September' => 0, 'October' => 0, 'November' => 0, 'December' => 0
        ];
        foreach ($ress as $entry) {
            $monthName = trim($entry->month);
            $months[$monthName] = (float) $entry->ca;
        }
        $formattedData = [];
        foreach ($months as $month => $ca) {
            $formattedData[] = ['month' => $month, 'ca' => $ca];
        }
//        dd($ress);
        return view('histo.histo',compact('formattedData'));
    }
    public  function  export()
    {
       $val=  Session::get('res');
        $pdf = Pdf::loadView('pdf.pdf', ['val' => $val]);
        return $pdf->download('document.pdf');
    }
    public  function  StatVentesPv()
    {
         $pv = Session::get('pv');
        $res = DB::select("select  EXTRACT(YEAR FROM date_vente) AS year from vente where idpv = ? group by year  ",[$pv[0]->id]);
        return view('stat.statpv',compact('res'));
    }
    public function traitstatpv(Request $request)
    {
        $pv = Session::get('pv');

        $res = DB::select("select  EXTRACT(YEAR FROM date_vente) AS year from  vente where idpv = ? group by year ",[$pv[0]->id]);
        $annee  =$request->input('date');
        $ress =  \App\Models\Laptop::get_chiffre_affaire_moispv($annee,$pv[0]->id);
//       dd($ress);
        Session::put('res',$ress);
        return view('stat.statpv',compact('ress','res'));
    }
    public  function benefice()
    {
        $res = DB::select("select  EXTRACT(YEAR FROM date_vente) AS year from vente group by year  ");
        return view('benefice.benefice',compact('res'));
    }
    public  function traibenefice(Request $request)
    {
        $res = DB::select("select  EXTRACT(YEAR FROM date_vente) AS year from vente group by year  ");
        $annee  =$request->input('date');
        $ress =  \App\Models\Laptop::get_Benefice_mois($annee);
        return view('benefice.benefice',compact('res'));
    }
}
