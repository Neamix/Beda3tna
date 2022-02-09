<?php

use App\Models\System;

function getSystemVariable($key) {
    return System::where('key',$key)->get()->toArray();
}