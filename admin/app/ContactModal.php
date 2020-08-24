<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactModal extends Model
{
    public $table= 'contacttable';
    public $primaryKey='id';
    public $incrementing= true;
    public $keyType='int';
    public $timestamps= false;
}
