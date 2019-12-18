<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    
    public function users(){
        return $this->belongsToMany('App\User', 'user_has_documents', 'document_id', 'user_id');
    }

}
