<?php

namespace Modules\Account\Services;

use Modules\Account\Repositories\UserRepository;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function createUser(...$params)
    {
        return $this->userRepository->add(...$params);
    }

    public function getAllUser()
    {
        return $this->userRepository->getAll();
    }

    public function getUserById($id)
    {
        return $this->userRepository->getById($id);
    }

    public function updateUser($id, ...$params)
    {
        return $this->userRepository->update($id, ...$params);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
