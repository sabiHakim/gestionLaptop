<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Login extends Model
{
    use HasFactory;
    protected $table = 'magasin';
    protected $fillable=['id','nom','mdp'];
    public   static  function  checkM($nom,$mdp)
    {
        $resultat = DB::select("select * from magasin where nom =? and mdp =?",[$nom,$mdp]);
        return $resultat;
    }

}
