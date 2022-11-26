<?php

namespace App\Repositories\Api;

use App\Models\Image;
use App\Models\Report;
use App\Services\FileServices;
use Illuminate\Support\Str;

//use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class ReportRepository.
 */
class ReportRepository
{
    /**
     * @var FileServices
     */
    private $fileServices;

    /**
     * @param FileServices $fileServices
     */
    public function __construct(FileServices $fileServices)
    {
        $this->fileServices = $fileServices;
    }
    /**
     * @return string
     *  Return the model
     */
    public function model(): string
    {
        return Report::class;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $user = auth()->user();
        $data['user_id'] = $user->id;

        $report = Report::create($data);

        if(isset($data['files'])){
            foreach ($data['files'] as $item){
                $fileName = rand(1000000, 99999999999) . Str::slug($item->getClientOriginalName(), '.');
                $path = $this->fileServices->savePhoto(500, $item, 'reportFiles/' . $report->id, $fileName);
//                $user->update([
//                    'avatar' => $path // '/storage/' . $path
//                ]);
                Image::create([
                    'path' => $path,
                    'type' => 'report file',
                    'imageable_type' => Report::class,
                    'imageable_id' => $report->id,
                ]);
            }


        }

        return $report;
    }
}
