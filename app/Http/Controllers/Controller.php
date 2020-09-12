<?php

namespace App\Http\Controllers;

use App\Library\Master;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function validatesRequests(Request $request, $rules, $messages = []) {
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return Master::validationResponse($validator);
        }
    }

}
