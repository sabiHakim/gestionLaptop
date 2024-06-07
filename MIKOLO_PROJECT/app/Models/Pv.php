<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pv extends Model
{
    use HasFactory;
    protected $table='pv';
    protected $fillable = ['id','nom','latitude','longitude','nbuser'];
    public  $timestamps = false;
    public  static function getAll(){
        $res = DB::select("select * from pv");
        return $res;
    }
    public   static function  deletepv($id)
    {
        $res = DB::select("delete from pv where id = ?",[$id]);
    }
    public static  function getById($id)
    {
        $result = DB::select('SELECT * FROM pv WHERE id =?', [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
    public static  function getUserById($id)
    {
        $result = DB::select('SELECT nbruser FROM pv WHERE id =?',[$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
    public   static  function updatepv($nbruser,$nom,$latitude,$longitude,$idpv)
    {
        $res  =  DB::select("update pv set nbruser = ? , nom = ? , latitude = ? , longitude=? where id = ?",[$nbruser,$nom,$latitude,$longitude,$idpv]);
    }
    public static  function getpv_where_not($id)
    {
        $res  =  DB::select("select * from pv where id != ?",[$id]);
        return $res;

    }
    public static function  updatesend($idsend,$nbr)
    {
        $res = DB::select(" update pv set nbruser = nbruser - ? where id = ?",[$nbr,$idsend]);
    }
    public static function  updatereceive($idreceive ,$nbr)
    {
        $res = DB::select(" update pv set nbruser = nbruser + ? where id = ?",[$nbr,$idreceive]);
    }
}
