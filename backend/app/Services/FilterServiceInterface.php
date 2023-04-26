<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

interface FilterServiceInterface
{
    public function getFilteredQuery(Builder $query): Builder;

    public function getConditonMethod(
        array $availableFilters,
        array $strictFilters,
        array $additionalStrictFilters,
        array $additionalNoStrictFilters
    ): array;

    public function getAvailableFilters(): array;

    public function getStrictFilters(): array;

    public function getAdditionalNoStrictFilters(): array;

    public function getAdditionalStrictFilters(): array;
}