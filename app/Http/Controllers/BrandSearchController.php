<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class BrandSearchController extends Controller
{
    public function __invoke(Request $request): Collection
    {
        return Brand::query()
            ->select('id', 'name', 'slug')
            ->when(
                $request->search,
                fn ($query) => $query
                    ->where('name', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', [])),
                fn ($query) => $query->limit(10)
            )
            ->orderBy('name')
            ->get();
    }
}
