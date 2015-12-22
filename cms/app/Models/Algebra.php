<?php

namespace App\Models;

class Algebra extends Model
{
    protected $table = 'queues';
    protected $type = '1';
    protected $numberOfWorkers = '3';
}