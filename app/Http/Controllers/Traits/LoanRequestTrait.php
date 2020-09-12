<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27-Mar-18
 * Time: 11:16 AM
 */

namespace App\Http\Controllers\Traits;


use Illuminate\Http\Request;

trait LoanRequestTrait
{
    /**
     * Fetch a loan's proposal
     */
    public function fetchproposal(Request $request)
    {
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        return file_get_contents("https://fint.ng/borrowers_portal/public/static/txt/"
            . ($request->write_up) . ".txt", false, stream_context_create($arrContextOptions));
    }
}
