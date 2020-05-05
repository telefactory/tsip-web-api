<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers\ServiceGroup;
use App\Models\Customers\Customer;
use App\ChangeLogHelper;
use DateTime;


class ServiceGroupController extends Controller
{
    /**
     * Get single ServiceGroup
     * 
     * @param SG_ID
     * 
     * @return array
     */
    public function get($id){
        $sg = ServiceGroup::find($id);

        if(!$sg){
            abort(404, 'Could not find servicegroup');
        }

        $this->authorize('show', $sg->customer);


        return $sg;
    }

   /**
     * Get all ServiceGroups for a given customer
     * 
     * @param C_ID
     * 
     * @return array
     */
    public function getAllServiceGroups($id){
        $sgs = ServiceGroup::where('C_ID', $id)->get();

        if(!$sgs){
            abort(404, 'Could not find any servicegroups for this customer');
        }

        $this->authorize('show', Customer::find($id));

        return $sgs;
    }

     /**
     * Update ServiceGroup
     * 
     * @param Illuminate\Http\Request $request
     * @param SG_ID
     * 
     * @return array
     */
    public function update(Request $request, $sg_id){
        $sg = ServiceGroup::where('SG_ID', $sg_id)->first();
        $this->authorize('update', $sg->customer);

        if(!$sg){
            abort(404, 'Could not find servicegroup');
        }

        $sg->update($request->json()->all());
        $sg = $sg->find($sg->SG_ID);

        $user = auth('api')->user();

        $cl = new ChangeLogHelper;
        $cl->writeChangeLogLine([
            'CF_ID' => $sg['callflow']['call_flow_id'],
            'ChangedBy' => $user->username,
            'ChangeDate' => new DateTime(),
            'ChangeType' => 'ServiceGroup',
            'Description' => 'updated'
        ]);

        return $sg;
    }
}
