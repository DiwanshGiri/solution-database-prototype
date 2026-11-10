<?php
namespace App\Services;

use Illuminate\Support\Collection;

class KpiSuggestionService
{
    /** Return KPIs that have been marked as useful for the selected problem. */
    public function forProblem(Collection $kpis, ?int $problemId): Collection
    {
        if (!$problemId) return collect();
        return $kpis->filter(fn ($kpi) => $kpi->problems->contains('id', $problemId))->values();
    }
}
