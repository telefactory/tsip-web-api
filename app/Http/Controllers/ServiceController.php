<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers\ServiceGroup;
use App\Models\Customers\Customer;
use App\Models\Customers\Service;

class ServiceController extends Controller
{
    /**
     * Get all services for a given Customer
     * optionally only members of a given ServiceGroup
     * 
     * @param C_ID
     * @param SG_ID (optional)
     * 
     * @return array
     */
    public function get($c_id, $sg_id = null)
    {
        $customer = Customer::find($c_id);
        $this->authorize('show', $customer);

        if($sg_id) {
            $services = Service::where('C_ID', $c_id)->where('SG_ID', $sg_id)->get();
        } else {
            $services = Service::where('C_ID', $c_id)->get();
        }

        if (!$services) {
            abort(404, 'Could not find any Services');
        }

        return $services;
    }

    /**
     * Update Service
     * 
     * @param Illuminate\Http\Request $request
     * @param C_ID
     * @param NR_ID
     * 
     * @return array
     */
    public function update(Request $request, $c_id, $nr_id)
    {
        $customer = Customer::find($c_id);
        $this->authorize('show', $customer);

        $service = Service::find($nr_id);

        if (!$service) {
            abort(404, 'Could not find module');
        }

        $service->update($request->json()->all());
        $service = Service::find($nr_id);

        return $service;
    }
}
