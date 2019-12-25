<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Document extends Model
{
    
    use Sortable;

    public function users(){
        return $this->belongsToMany('App\User', 'user_has_documents', 'document_id', 'user_id');
    }

    public $sortable = ['id', 'title', 'created_at', 'role_id'];

}
