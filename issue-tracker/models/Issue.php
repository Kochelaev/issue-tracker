<?php

namespace Models;

class Issue extends BaseModel
{
    protected $table = 'issues';
    protected $fillables = [
        'email',
        'name',
        'title',
        // 'description',
        'updated_by',
        'status',
    ];
}
