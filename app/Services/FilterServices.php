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
                $q->where('first_name', $data['search'])
                    ->orWhere('last_name', $data['search'])
                    ->orWhere('last_name', $data['search'])
                    ->orWhere('number', $data['search']);
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
                $q->where('title', $data['search'])
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
//            dd($endDate,date('Y-m-d H:i:s', strtotime($endDate)));
//dd(str_replace('T', ' ', $data['start_date']));

            $query = $query
                ->whereBetween('created_at', [date('Y-m-d H:i:s', strtotime($startDate)), date('Y-m-d H:i:s', strtotime($endDate))]);
//                ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($startDate)))
//                ->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($endDate)));
        }
        return $query;
    }
}