<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf as PDF;

/**
 * Class FileServices
 * @package App\Services
 */
class FileServices
{
    /**
     * @param $html
     * @param $data
     * @return \Barryvdh\DomPDF\PDF
     */
    public function createPDF($html, $data){
        return Pdf::loadView($html, $data);
    }
}
