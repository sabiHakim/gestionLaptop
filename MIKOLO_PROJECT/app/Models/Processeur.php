<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Processeur extends Model
{
    use HasFactory;
    protected  $table='processeur';
    protected $fillable = ['id','nom'];
    public  $timestamps = false;

    public static  function getById($id)
    {
        $result = DB::select('SELECT * FROM processeur WHERE id =?', [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
    public  static  function updatem($id,$marque)
    {
        $res = DB::select("update processeur set nom = ? where id = ?",[$marque,$id]);
        return $res;
    }
    public   static function  deletem($id)
    {
        $res = DB::select("delete from processeur where id = ?",[$id]);
    }
}

