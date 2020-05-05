<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers\Customer;
use App\Models\Customers\Service;
use App\Models\Statistics\CDRDaily;

class StatisticsController extends Controller
{
    /**
     * Get statitics for customer
     * 
     * @return array
     */
    public function getCustomerStatistics($id, $from, $to){
        $customer = Customer::find($id);
        $this->authorize('statistics', $customer);

        if(!$customer){
            abort(404, 'Could not find customer');
        }

        $numbers = Service::where('C_ID', $customer->C_ID)->get();

        foreach($customer->service_groups as $sg) {
            foreach($sg->number_list as $number) {
                $numbers[] = $number;
            }
        }

        if(count($numbers) == 0){
            return [];
        }

        $statistics = CDRDaily::where(function($query) use($numbers){
            $first = true;
            foreach($numbers as $number){
                $query->{$first ? 'where' : 'orWhere'}('original_number', $number->ServiceNumber);
                $first = false;
            }
        })->whereDate('timestamp', '>=', $from)
        ->whereDate('timestamp', '<=', $to)
        ->orderBy('timestamp')
        ->orderBy('direction')->get();

        return $statistics;
    }
}
