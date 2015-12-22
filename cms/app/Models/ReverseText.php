<?php

namespace App\Models;

class ReverseText extends Model
{
    protected $table = 'queues';
    protected $type = '4';
    protected $numberOfWorkers = '3';
}