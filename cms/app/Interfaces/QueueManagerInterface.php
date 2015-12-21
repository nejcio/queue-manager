<?php

namespace app\Controllers;

interface QueueManagerInterface {

    public static function DispatchJob($request, $type);

}