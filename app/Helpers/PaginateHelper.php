<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginateHelper
{


    public static function paginate($posts){
        $perPage = 10; // Change the value to the desired number of items per page

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentPageItems = $posts->forPage($currentPage, $perPage);

        $posts = new LengthAwarePaginator(
            $currentPageItems,
            $posts->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return $posts;
    }
}
