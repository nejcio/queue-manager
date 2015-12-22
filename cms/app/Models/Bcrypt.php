<?php

namespace App\Models;

class Bcrypt extends Model
{
    protected $table = 'queues';
    protected $type = '2';
    protected $numberOfWorkers = '3';
}