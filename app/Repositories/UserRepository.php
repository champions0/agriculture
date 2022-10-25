<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
//use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\User;

/**
 * Class UserRepository.
 */
class UserRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @param array $data
     * @return array
     */
    public function createUser(array $data)
    {
        DB::beginTransaction();
        $data['user'] = User::create($data);
//        $data['user'] = parent::create($data);

        DB::commit();

        return $data;
    }
}
