<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Customers\Customer;

class CustomerController extends Controller
{
    /**
     * Get single customer
     * 
     * @return array
     */
    public function get($id){
        $customer = Customer::find($id);
        $this->authorize('show', $customer);

        if(!$customer){
            abort(404, 'Could not find customer');
        }

        return $customer;
    }

    /**
     * Get all customers
     * 
     * @return array
     */
    public function getAllCustomers(){
        $customers = DB::connection('customers')->table('Customer')->get();

        $result = array();

        foreach($customers as $customer) {
            $new['customer_name'] = $customer->CustomerName;
            $new['customer_id'] = $customer->C_ID;
            $result[] = $new;
        }
        return $result;
    }

    /**
     * Update customer
     * 
     * @param Illuminate\Http\Request $request
     * 
     * @return array
     */
    public function update(Request $request){
        $customer = Customer::find($request->input('customer_id'));
        $this->authorize('update', $customer);

        if(!$customer){
            abort(404, 'Could not find customer');
        }

        $customer->update($request->json()->all());
        $customer = $customer->find($customer->C_ID);

        return $customer;
    }
}
