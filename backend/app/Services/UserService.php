<?php

namespace App\Services;

use App\DTO\UserFields;
use App\Models\User;

class UserService
{
	public function getAll()
	{
		return User::all();
	}

	public function getById($id)
	{
        return User::whereId($id)->first();
	}

	public function create(UserFields $fields)
	{
		return User::factory()->create($fields->toArray());
	}

	public function update(UserFields $fields, $id)
	{
        $user = User::whereId($id)->first();
        return $user->update($fields->toArray());
	}

	public function delete($id)
	{
        return User::whereId($id)->first()->delete();
	}
}
