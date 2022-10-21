<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PaginationController extends Controller
{
    public static function paginate($items, $perPage = 5, $page = null)
    {
        $page = $page ?? (Paginator::resolveCurrentPage() ?? 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new Paginator($items->forPage($page, $perPage), $perPage, $page);
    }
}
