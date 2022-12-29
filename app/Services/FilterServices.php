<?php

namespace App\Services;

/**
 * Class FilterServices
 * @package App\Services
 */
class FilterServices
{
    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public function user($query, $data)
    {
        if (isset($data['search']) && $data['search'] !== null) {
            $query = $query->where(function ($q) use ($data) {
                $q->where('first_name', 'like', '%' .  $data['search'] . '%')
                    ->orWhere('last_name', 'like', '%' .  $data['search'] . '%')
                    ->orWhere('number', md5($data['search']))
                    ->orWhere('id', $data['search']);
            });
        }

        if (isset($data['status']) && $data['status'] !== null) {
            $query = $query->where('status', $data['status']);
        }
        return $query;
    }

    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public function report($query, $data)
    {
        if (isset($data['search']) && $data['search'] !== null) {
            $query = $query->where(function ($q) use ($data) {
                $q->where('title', 'like', '%' . $data['search'] . '%')
                    ->orWhere('id', $data['search']);
            });
        }

        if (isset($data['status']) && $data['status'] !== null) {
            $query = $query->where('status', $data['status']);
        }

        if (isset($data['start_date']) && $data['start_date'] !== null) {
            $startDate = str_replace('T', ' ', $data['start_date']);
            $endDate = now();
            if (isset($data['end_date']) && $data['end_date'] !== null) {
                $endDate = $data['end_date'];
            }

            $query = $query
                ->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime($startDate)), date('Y-m-d H:i:s', strtotime($endDate))]);
        }
        return $query;
    }

    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public function fastQuestions($query, $data)
    {
        if (isset($data['search']) && $data['search'] !== null) {
            $query = $query->where(function ($q) use ($data) {
                $q->where('number', 'like', '%' . $data['search'] . '%')
                    ->orWhere('id', $data['search'])
                    ->orWhereHas('category', function ($query) use ($data) {
                        $query->where('name', 'like', '%' . $data['search'] . '%');
                    });
            });
        }

        if (isset($data['status']) && $data['status'] !== null) {
            $query = $query->where('status', $data['status']);
        }

        if (isset($data['category_id']) && $data['category_id'] !== null) {
            $query = $query->where('category_id', $data['category_id']);
        }

        if (isset($data['start_date']) && $data['start_date'] !== null) {
            $startDate = str_replace('T', ' ', $data['start_date']);
            $endDate = now();
            if (isset($data['end_date']) && $data['end_date'] !== null) {
                $endDate = $data['end_date'];
            }

            $query = $query
                ->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime($startDate)), date('Y-m-d H:i:s', strtotime($endDate))]);
        }

        return $query;
    }

    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public function event($query, $data){
        if (isset($data['search']) && $data['search'] !== null) {
            $query = $query->where(function ($q) use ($data) {
                $q->where('title', 'like', '%' . $data['search'] . '%')
                    ->orWhere('organizer', 'like', '%' . $data['search'] . '%')
                    ->orWhere('id', $data['search']);
            });
        }

        if (isset($data['status']) && $data['status'] !== null) {
            $query = $query->where('status', $data['status']);
        }

        if (isset($data['start_date']) && $data['start_date'] !== null) {
            $startDate = str_replace('T', ' ', $data['start_date']);
            $endDate = now();
            if (isset($data['end_date']) && $data['end_date'] !== null) {
                $endDate = $data['end_date'];
            }

            $query = $query
                ->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime($startDate)), date('Y-m-d H:i:s', strtotime($endDate))]);
        }

        if(isset($data['subject_id']) && $data['subject_id'] !== null){
            $query = $query->where('subject_id', $data['subject_id']);
//            $query = $query->where(function($q) use ($data) {
//                $q->whereHas('subject', function ($query) use ($data){
//                    $query->where
//                });
//            });
        }

        return $query;
    }

    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public function statement($query, $data){
        if (isset($data['search']) && $data['search'] !== null) {
            $query = $query->where(function ($q) use ($data) {
                $q->where('title', 'like', '%' . $data['search'] . '%')
                    ->orWhere('declarant_first_name', 'like', '%' . $data['search'] . '%')
                    ->orWhere('declarant_last_name', 'like', '%' . $data['search'] . '%')
                    ->orWhere('id', $data['search']);
            });
        }

        if (isset($data['status']) && $data['status'] !== null) {
            $query = $query->where('status', $data['status']);
        }

        return $query;
    }

    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public function news($query, $data){
        if (isset($data['search']) && $data['search'] !== null) {
            $query = $query->where(function ($q) use ($data) {
                $q->where('title', 'like', '%' . $data['search'] . '%');
            });
        }

        if (isset($data['status']) && $data['status'] !== null) {
            $query = $query->where('status', $data['status']);
        }

        if (isset($data['start_date']) && $data['start_date'] !== null) {
            $endDate = now();
            if(isset($data['end_date']) && $data['end_date'] !== null){
                $endDate = $data['end_date'];
            }
            $query = $query
                ->whereBetween('news_date', [ date('Y-m-d H:i:s', strtotime($data['start_date'])), date('Y-m-d H:i:s', strtotime($endDate))]);
        }

        return $query;
    }

    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public function notification($query, $data)
    {
        if (isset($data['search']) && $data['search'] !== null) {
            $query = $query->where('title', 'like', '%' .  $data['search'] . '%');
        }

        if (isset($data['status']) && $data['status'] !== null) {
            $query = $query->where('status', $data['status']);
        }

        if (isset($data['type']) && $data['type'] !== null) {
            $query = $query->where('type', $data['type']);
        }

        return $query;
    }

}
