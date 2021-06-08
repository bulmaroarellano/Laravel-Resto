<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the payment can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list payments');
    }

    /**
     * Determine whether the payment can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Payment  $model
     * @return mixed
     */
    public function view(User $user, Payment $model)
    {
        return $user->hasPermissionTo('view payments');
    }

    /**
     * Determine whether the payment can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create payments');
    }

    /**
     * Determine whether the payment can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Payment  $model
     * @return mixed
     */
    public function update(User $user, Payment $model)
    {
        return $user->hasPermissionTo('update payments');
    }

    /**
     * Determine whether the payment can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Payment  $model
     * @return mixed
     */
    public function delete(User $user, Payment $model)
    {
        return $user->hasPermissionTo('delete payments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Payment  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete payments');
    }

    /**
     * Determine whether the payment can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Payment  $model
     * @return mixed
     */
    public function restore(User $user, Payment $model)
    {
        return false;
    }

    /**
     * Determine whether the payment can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Payment  $model
     * @return mixed
     */
    public function forceDelete(User $user, Payment $model)
    {
        return false;
    }
}
