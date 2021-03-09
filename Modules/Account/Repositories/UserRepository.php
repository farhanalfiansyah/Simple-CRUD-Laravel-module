<?php

namespace Modules\Account\Repositories;

interface UserRepository
{
    public function add(...$params);
    public function update($id, ...$params);
    public function delete($id);
    public function getAll();
    public function getById($id);
}
