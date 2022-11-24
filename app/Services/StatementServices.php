<?php

namespace App\Services;

use App\Models\Statement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class StatementServices
 * @package App\Services
 */
class StatementServices
{
    /**
     * @var FileServices
     */
    private $fileServices;

    /**
     * StatementServices constructor.
     * @param FileServices $fileServices
     */
    public function __construct(FileServices $fileServices)
    {
        $this->fileServices = $fileServices;
    }

    /**
     * @param $data
     */
    public function create($data)
    {
        DB::beginTransaction();

        $statement = Statement::create([
            'title' => $data['title'],
            'description' => $data['title'],
            'statement_date' => date('Y-m-d H:i:s', strtotime($data['statement_date'])),
            'deadline' => date('Y-m-d H:i:s', strtotime($data['deadline'])),
            'declarant_first_name' => $data['declarant_first_name'],
            'declarant_last_name' => $data['declarant_last_name'],
            'status' => $data['status'],
        ]);

        if (isset($data['wallpaper'])) {
            $imageFileName = rand(1000000, 99999999999) . Str::slug($data['wallpaper']->getClientOriginalName(), '.');
            $path = $this->fileServices->savePhoto(500, $data['wallpaper'], 'statements/' . $statement['id'], $imageFileName);
            $statement->update([
                'wallpaper' => $path // '/storage/' . $path
            ]);
        }

        DB::commit();
    }

    /**
     * @param $statement
     * @param $data
     */
    public function update($statement, $data)
    {
        DB::beginTransaction();
        $statement->update([
            'title' => $data['title'],
            'description' => $data['title'],
            'statement_date' => date('Y-m-d H:i:s', strtotime($data['statement_date'])),
            'deadline' => date('Y-m-d H:i:s', strtotime($data['deadline'])),
            'declarant_first_name' => $data['declarant_first_name'],
            'declarant_last_name' => $data['declarant_last_name'],
            'status' => $data['status'],
        ]);

        if (isset($data['wallpaper'])) {
            if(isset($statement->wallpaper)){
                Storage::delete('public/' . $statement->wallpaper);

            }
            $imageFileName = rand(1000000, 99999999999) . Str::slug($data['wallpaper']->getClientOriginalName(), '.');
            $path = $this->fileServices->savePhoto(500, $data['wallpaper'], 'statements/' . $statement['id'], $imageFileName);
            $statement->update([
                'wallpaper' => $path // '/storage/' . $path
            ]);
        }

        DB::commit();

    }
}
