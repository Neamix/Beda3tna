<?php

namespace App\Http\Controllers;

use App\Http\Requests\SystemRequest;
use App\Models\System;
use App\Traits\validationTrait;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    use validationTrait;

    public function update(SystemRequest $request) {
        return System::systemUpdate($request);
    }

    public function getSystemVariables()
    {
        return System::all();
    }

    public function getSystemVariable($key)
    {
        return System::getSystemVariable($key);
    }
}
