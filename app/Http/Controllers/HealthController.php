<?php

namespace App\Http\Controllers;

use DB;

class HealthController extends Controller
{
    public function getHealth() {

        $result['status'] = 'ok';
        $message ='Health check successful';

        try {
            // Test all connections
            DB::connection('mysql')->getPdo();
            DB::connection('customers')->getPdo();
            DB::connection('stats')->getPdo();
        } catch (\Exception $e) {
            $result['status'] = 'fail';
            $message = 'Could not connect to the database.  Please check your configuration. error:' . $e;
        }
        return $this->sendResponse($result, $message);
    }

    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }
}
