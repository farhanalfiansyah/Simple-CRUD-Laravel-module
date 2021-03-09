<?php

namespace Modules\Account\Http\Controllers;

use Modules\Account\Http\Requests\CreateUserRequest;
use Modules\Account\Http\Requests\UpdateUserRequest;
use Modules\Account\Http\Resources\UserResource;
use Modules\Account\Services\UserService;

class AccountController extends Controller
{
    public function __construct(
        private UserService $userService,
    ) {}

    public function index()
    {
        try{
            $user = $this->userService->getAllUser();

            return $this->sendData(UserResource::collection($user));
        }catch(\Exception $e){
            return $this->handleException($e);
        }
    }

    public function store(CreateUserRequest $request)
    {
        try {
            $this->userService->createUser($request->validated());

            return $this->sendOk();
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function show($id)
    {
        try {
            $user = $this->userService->getUserById($id);

            return $this->sendData(new UserResource($user));
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $this->userService->updateUser($id, $request->validated());

            return $this->sendOk();
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete($id)
    {
        try {
            $this->userService->deleteUser($id);

            return $this->sendOk();
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
