<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Laptop extends Model
{
    use HasFactory;
    protected $table = 'laptops';
    public  $timestamps = false;
    protected  $fillable = ['id','marque_id','modele','processeur_id','ram','ecran','disque_dur','prix'];
    public   static  function affichageLaptop()
    {
        $res   =  DB::select("select * from v_laptop");
        return $res;
    }
    public   static  function mLaptop($id)
    {
        $res  =  DB::select("select * from laptops where id = ?",[$id]);
        return $res;
    }
    public   static  function updateLap($marque,$modele,$proc,$ram,$ecran,$disque,$id)
    {
        $res  =  DB::select("update laptops set marque_id = ? , modele = ? , processeur_id = ? , ram=?,ecran=?,disque_dur=? where id = ?",[$marque,$modele,$proc,$ram,$ecran,$disque,$id]);
    }
    public   static function  deletelap($id)
    {
        $res = DB::select("delete from laptops where id = ?",[$id]);
    }
    public  static function  achat($id,$nbr)
    {
        DB::select("insert into stockM(idlaptop,nbr,dateachat)values (?,?,now())",[$id,$nbr]);
    }
    public  static  function  insert_reception($idpv,$idlap,$nbr)
    {
        DB::select("insert into receptionlap(idpv,idlap,nbr,date_reception)values (?,?,?,now())",[$idpv,$idlap,$nbr]);
    }
    public   static function  insertVentes($lap,$pv,$nbr)
    {
        DB::select("insert into vente(idpv,idlap,nbr,date_vente) values (?,?,?,now())",[$pv,$lap,$nbr]);
    }
    public  static function  perte($idpv,$idlap,$nbr)
    {
           $res =  DB::select("insert into perte(idpv,idlap,nbr) values (?,?,?)",[$idpv,$idlap,$nbr]);
           return $res;
    }
    public  static function  get_chiffre_affaire_mois($annee)
    {
     $res = DB::select(" SELECT TO_CHAR(date_vente, 'Month') AS month,SUM(prix) AS ca FROM vue_ventes_laptops WHERE EXTRACT(YEAR FROM date_vente) =?   GROUP BY month",[$annee]);
     return $res;
    }
    public  static function  get_Benefice_mois($annee)
    {
     $res = DB::select(" SELECT TO_CHAR(date_vente, 'Month') AS month,SUM(prix) AS ca FROM vue_ventes_laptops WHERE EXTRACT(YEAR FROM date_vente) =?   GROUP BY month",[$annee]);
     return $res;
    }
    public  static function  get_chiffre_affaire_moispv($annee,$idpv)
    {
     $res = DB::select(" SELECT TO_CHAR(date_vente, 'Month') AS month,SUM(prix) AS ca FROM vue_ventes_laptops WHERE EXTRACT(YEAR FROM date_vente) = ? and  idpv = ?   GROUP BY month",[$annee,$idpv]);
     return $res;
    }
//    public static function perte()
//    {
//        $res=  DB::select("select * from perte where idpv= ?");
//    }
}
