<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stock extends Model
{
    use HasFactory;
    public  static  function transfertLap_pv($idpv,$idLap,$nbr)
    {
        $res = DB::select("insert into stock_lap_pv(idpv,idlap,nb) values (?,?,?)",[$idpv,$idLap,$nbr]);
        return $res;
    }
    public  static function  getStockBy_Lap($idlap)
    {
        $res = DB::select("select sum from v_stock_lap where  idlaptop = ?",[$idlap]);
        $result = $res[0];
        return $result->sum;
    }
    public  static function  transfertLap_mag($lap,$nbr)
    {
        $res = DB::select("WITH LastRecord AS (
                                                        SELECT id
                                                        FROM stockm
                                                        WHERE idlaptop = ?
                                                        ORDER BY id DESC
                                                        LIMIT 1
                                                    )
                                                    UPDATE stockm
                                                    SET nbr = nbr + ?
                                                    WHERE id IN (SELECT id FROM LastRecord);
                                                    ",[$lap,$nbr]);
        return $res;
    }

    public  static function  getStockBy_Lap_pv($pv,$idlap)
    {
        $res = DB::select("select sum from v_stock_reception where  idlap = ? and idpv = ?",[$idlap,$pv]);
        $result = $res[0];
        return $result->sum;
    }

}
