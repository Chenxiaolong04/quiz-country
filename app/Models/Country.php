<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // Se la tabella si chiama diversamente dal nome plurale standard
    protected $table = 'countries';
    protected $primaryKey = null;         // Nessuna PK
    public $incrementing = false;         // Nessun ID incrementale
    // Se vuoi disabilitare timestamps (created_at, updated_at)
    public $timestamps = false;

    // Campi assegnabili in massa (opzionale, per sicurezza)
    // protected $fillable = ['nome_campo1', 'nome_campo2', 'nome_campo3'];
}
