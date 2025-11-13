<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use Notifiable;

    // ✅ Spécifie la bonne table
    protected $table = 'utilisateurs';

    protected $fillable = ['nom', 'email', 'prenoms', 'email', 'motDePasse', 'role', 'status'];
    protected $hidden = ['motDePasse'];
    public function getAuthPassword()
    {
        return $this->motDePasse;
    }
}
