<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class FilterServiceBase implements FilterServiceInterface
{

    public function getFilteredQuery(Builder $query): Builder
    {
        $availableFilters = $this->getAvailableFilters();
        $strictFilters = $this->getStrictFilters();
        $additionalStrictFilters = $this->getAdditionalStrictFilters();
        $additionalNoStrictFilters = $this->getAdditionalNoStrictFilters();

        $conditions = $this->getConditonMethod(
            $availableFilters,
            $strictFilters,
            $additionalStrictFilters,
            $additionalNoStrictFilters
        );

        $query->when(request()->filled('filter'), function ($query) use ($conditions) {
            $filters = explode(',', request('filter'));

            foreach ($filters as $filter) {
                [$criteria, $value] = explode(':', $filter);

                if (key_exists($criteria, $conditions)) {
                    if ($conditions[$criteria]['strict']) {
                        $query->where($criteria, $value);
                    } else {
                        $query->whereLike($criteria, $value);
                    }
                }
            }
            return $query;
        });

        return $query;
    }

    public function getConditonMethod(
        array $availableFilters,
        array $strictFilters,
        array $additionalStrictFilters,
        array $additionalNoStrictFilters
    ): array {
        $filters = [];

        if (empty($strictFilters)) {
            foreach ($availableFilters as $key => $availableFilter) {
                $filters[$key] = [
                    'strict' => false,
                ];
            }
        } else {
            foreach ($availableFilters as $key => $availableFilter) {
                if (in_array($key, $strictFilters)) {
                    $filters[$key] = [
                        'strict' => true,
                    ];
                } else {
                    $filters[$key] = [
                        'strict' => false,
                    ];
                }
            }
        }

        if (!empty($additionalStrictFilters)) {
            foreach ($additionalStrictFilters as $filter) {
                $filters[$filter] = [
                    'strict' => true,
                ];
            }
        }

        if (!empty($additionalNoStrictFilters)) {
            foreach ($additionalNoStrictFilters as $filter) {
                $filters[$filter] = [
                    'strict' => false,
                ];
            }
        }

        return $filters;
    }

    public function getAvailableFilters(): array
    {
        return [];
    }


    public function getStrictFilters(): array
    {
        return [];
    }

    public function getAdditionalNoStrictFilters(): array
    {
        return [];
    }

    public function getAdditionalStrictFilters(): array
    {
        return [];
    }

}