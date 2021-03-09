<?php

namespace Modules\Account\Repositories;

use Modules\Account\Models\User;

class EloquentUserRepository implements UserRepository
{
    public function add(...$params)
    {

        // if (isset($params['photo']) && isset($params['ktp'])) {
        //     $params['photo'] = $params['photo']->store('public/image');
        //     $params['ktp'] = $params['ktp']->store('public/image');
        // }
        return User::create(...$params);
    }

    public function getAll()
    {
        return User::all();
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function update($id, ...$params)
    {
        $user = $this->getById($id);

        return $user->update(...$params);
    }

    public function delete($id)
    {
        $user = $this->getById($id);

        return $user->delete();
    }
}
