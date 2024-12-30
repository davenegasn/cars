<?php

namespace App\Http\Controllers;

use App\Models\VehicleYear;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class VehicleYearSearchController extends Controller
{
    public function __invoke(Request $request): Collection
    {
        return VehicleYear::query()
            ->select('id', 'year')
            ->when(
                $request->search,
                fn ($query) => $query
                    ->where('year', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', [])),
                fn ($query) => $query->limit(10)
            )
            ->orderBy('id', 'desc')
            ->get();
    }
}
