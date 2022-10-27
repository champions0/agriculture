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
//        DB::beginTransaction();
//        dd($data);
//        DB::commit();

        return User::create($data);
    }
}
