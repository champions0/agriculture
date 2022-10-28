<?php

namespace App\Repositories\Api;

use App\Models\FastQuestion;
use App\Models\Image;
use App\Services\FileServices;
use Illuminate\Support\Str;

//use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

/**
 * Class FastQuestionRepository.
 */
class FastQuestionRepository
{
    /**
     * @var FileServices
     */
    private $fileServices;

    /**
     * FastQuestionRepository constructor.
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
    public function model()
    {
        return FastQuestion::class;
    }

    public function create(array $data)
    {
        $user = auth()->user();
        $data['number'] = $user->number;
        $data['user_id'] = $user->id;

        $fastQuestion = FastQuestion::create($data);

        if(isset($data['images'])){
            foreach ($data['images'] as $item){
                $imageFileName = rand(1000000, 99999999999) . Str::slug($item->getClientOriginalName(), '.');
                $path = $this->fileServices->savePhoto(500, $item, 'fastQuestions/' . $fastQuestion->id, $imageFileName);
//                $user->update([
//                    'avatar' => $path // '/storage/' . $path
//                ]);
                Image::create([
                    'path' => $path,
                    'type' => 'fast question image',
                    'imageable_type' => FastQuestion::class,
                    'imageable_id' => $fastQuestion->id,
                ]);
            }


        }

        return $fastQuestion;
    }
}
