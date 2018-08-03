<?php

namespace App;

use App\Scope\BuyerScope;
use Illuminate\Database\Eloquent\Model;
use App\Transaction;

class Buyer extends User
{

    protected static function boot(){
        parent::boot();
        static::addGlobalScope(new BuyerScope());
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
