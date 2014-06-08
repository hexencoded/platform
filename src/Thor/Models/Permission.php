<?php

namespace Thor\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    
    protected $fillable = array(
        'name', 'display_name'
    );
}
