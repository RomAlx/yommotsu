<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountInfo extends Model
{
    protected $table = 'account_info';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Define the relationships with other models if needed
}