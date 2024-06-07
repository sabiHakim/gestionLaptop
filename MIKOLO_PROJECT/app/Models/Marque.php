<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Marque extends Model
{
    use HasFactory;
    protected $table='marque';
    protected $fillable = ['nom'];
    public  $timestamps = false;

   public static  function getById($id)
    {
        $result = DB::select('SELECT * FROM marque WHERE id =?', [$id]);
        if (!empty($result)) {
            return $result[0];
        } else {
            return null;
        }
    }
    public  static  function updatem($id,$marque)
    {
        $res = DB::select("update marque set nom = ? where id = ?",[$marque,$id]);
        return $res;
    }
    public   static function  deletem($id)
    {
        $res = DB::select("delete from marque where id = ?",[$id]);
    }

}
