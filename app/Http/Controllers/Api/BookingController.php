<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;


class BookingController extends Controller
{
  
    public function store(Request $request)
    {

        $messages = [];
        $client_id = null;
        $pickup_location_address = null;
        $pickup_location_lat = null;
        $pickup_location_lon = null;

        $dropoff_location_address = null;
        $dropoff_location_lat = null;
        $dropoff_location_lon = null;

        $stop_locations = [];

        foreach ($request->locations ?? [] as $index => $loc) {

            if ($index == 0) {
                $label = 'Pickup location';
                $pickup_location_address = $loc['address'] ?? null;
                $pickup_location_lat = $loc['lat'] ?? null;
                $pickup_location_lon = $loc['lng'] ?? null;
            } elseif ($index == 1) {
                $label = 'Dropoff location';
                $dropoff_location_address = $loc['address'] ?? null;
                $dropoff_location_lat = $loc['lat'] ?? null;
                $dropoff_location_lon = $loc['lng'] ?? null;

            } else {
                $label = 'Stop point ' . ($index - 1);
                 $stop_locations[] = [
                    'address' => $loc['address'] ?? null,
                    'lat' => $loc['lat'] ?? null,
                    'lng' => $loc['lng'] ?? null,
                ];
            }

            $messages["locations.$index.address.required"] = "$label is required";
        }

        $customer_found = (!empty($request->get('client_id')))? '' : 'required';

        $validator = Validator::make($request->all(), [
            'contact_number' => 'required',
            'pickup_date' => 'required',
            'pickup_time' => 'required',
            'locations' => 'required|array',
            'locations.*.address' => 'required',
            'passengers' => 'required',
            'first_name'=> $customer_found,
            'last_name'=> $customer_found,
            'email'=> (!empty($customer_found))? $customer_found.'|unique:clients,email' : '',

        ], $messages);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'validation' => true, 'need_requirements' => false, 'message' => 'Please fill all required input!', 'errors' => $validator->errors()]);
        }


        $client = Client::firstWhere('contact_number', $request->phone_contact);

        if (!$client) {
           $client = Client::create([
            'contact_number' => $request->get('phone_contact'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
           ]);
        }


        $booking = Booking::create([
                'client_id' => $client->id,
                'pickup_date' => $request->get('pickup_date'),
                'pickup_time' => $request->get('pickup_time'),
                'pickup_location_address' => $pickup_location_address,
                'pickup_location_lat' => $pickup_location_lat,
                'pickup_location_lon' => $pickup_location_lon,
                'dropoff_location_address' => $dropoff_location_address,
                'dropoff_location_lat' => $dropoff_location_lat,
                'dropoff_location_lon' => $dropoff_location_lon,
        ]);


        foreach ($stop_locations as $i => $stop) {
            $booking->stops()->create([
                'stop_order' => $i + 1,
                'stops_address' => $stop['address'],
                'lat' => $stop['lat'],
                'lon' => $stop['lng'],
            ]);
        }

        return response()->json(['status' => true, 'validation' => false, 'need_requirements' => false, 'message' => 'Your booking has been successfully confirmed. Thank you for choosing our service.']);
    }
}