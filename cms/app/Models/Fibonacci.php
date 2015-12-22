<?php

namespace App\Models;

class Fibonacci extends Model
{
    protected $table = 'queues';
    protected $type = '3';
    protected $numberOfWorkers = '3';
}