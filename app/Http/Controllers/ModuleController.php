<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers\ServiceGroup;
use App\Models\Customers\Module;
use App\ChangeLogHelper;
use DateTime;

class ModuleController extends Controller
{
        /**
     * Get single Module
     * 
     * @param CF_ID
     * @param MID
     * 
     * @return array
     */
    public function get($cf_id, $mid){
        
        // There is never more than one ServiceGroup for a given CF_ID
        $sg = ServiceGroup::where('CF_ID', $cf_id)->first();
        $this->authorize('show', $sg->customer);

        // There is never more than one combination of CF_ID and MID
        $module = Module::where('CF_ID', $cf_id)->where('MID', $mid)->first();

        if(!$module){
            abort(404, 'Could not find module');
        }

        return $module;
    }

        /**
     * Update Module
     * 
     * @param Illuminate\Http\Request $request
     * @param CF_ID
     * @param MID
     * 
     * @return array
     */
    public function update(Request $request, $cf_id, $mid){
        $sg = ServiceGroup::where('CF_ID', $cf_id)->first();
        $this->authorize('update', $sg->customer);

        $module = Module::where('CF_ID', $cf_id)->where('MID', $mid)->first();

        if(!$module){
            abort(404, 'Could not find module');
        }

        $module->setDataAttribute($request->all());
        $module->save();

        $user = auth('api')->user();

        $cl = new ChangeLogHelper;

        $cl->writeChangeLogLine([
            'CF_ID' => $sg['callflow']['call_flow_id'],
            'ChangedBy' => $user->username,
            'ChangeDate' => new DateTime(),
            'ChangeType' => $module->TableName,
            'Description' => 'updated'
        ]);

        return $module;
    }
}
