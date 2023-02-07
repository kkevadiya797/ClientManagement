<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'url', 'company_name', 'system_title', 'login_page_title', 'copyrights', 'favicon', 'logo', 'login_logo'
    ];
}
