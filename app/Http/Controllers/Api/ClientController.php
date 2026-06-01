<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
   public function verifyContactNumber(Request $request)
    {
        $client = Client::firstWhere('contact_number', $request->phone);

        if (!$client) {
           return response()->json(['status' => false, 'message' => 'We don\'t have that phone number on file. Please provide additional contact information.']);
        }else{
            return response()->json(['status' => true, 'id' => $client->id, 'message' => 'Hi '.$client->first_name.', Thank you for booking again!']);
        }
        
    }
}