<?php

namespace App\Policies\Customers;

use App\Models\Users\User;
use App\Models\Customers\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if a user can get a customer
     * 
     * @return bool
     */
    public function show(User $user, Customer $customer)
    {
        if (!$user->hasRole(['superadmin']) && $user->hasRole(['admin', 'customer', 'agent']) && $customer->customer_id != $user->customer_id) {
            return abort(403, 'Insufficient privileges');
        }
        return true;
    }

    /**
     * Determine if a user can update a specific customer
     * 
     * @param App\Models\Users\User $user
     * @param App\Models\Customers\Customer $customer
     * 
     * @return bool
     */
    public function update(User $user, Customer $customer)
    {
        if (!$user->hasRole(['superadmin']) && $user->hasRole(['admin', 'customer', 'agent']) && $customer->customer_id != $user->customer_id) {
            return abort(403, 'Insufficient privileges');
        }

        return true;
    }

    /**
     * Determine if a user can see statistics for a customer
     * 
     * @param App\Models\Users\User $user
     * @param App\Models\Customer\Customer $customer
     * 
     * @return bool
     */
    public function statistics(User $user, Customer $customer)
    {
        if (!$user->hasRole(['superadmin']) && $user->hasRole(['admin', 'customer', 'agent']) && $customer->customer_id != $user->customer_id) {
            return abort(403, 'Insufficient privileges');
        }

        return true;
    }
}
