<?php


use Illuminate\Database\Eloquent\Scope;

class UserUnlockSecretScope implements Scope
{


    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(\Illuminate\Database\Eloquent\Builder $builder, \Illuminate\Database\Eloquent\Model $model)
    {
        // TODO: Implement apply() method.
    }
}
