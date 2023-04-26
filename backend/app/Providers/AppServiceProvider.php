<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Builder::macro('whereLike', function ($column, $search) {
            return $this->where($column, 'LIKE', "%{$search}%");
        });

        Builder::macro('whereLikeMultipleColumn', function ($columns, $search) {
            $this->where(function ($query) use ($columns, $search) {
                foreach (array_wrap($columns) as $column) {
                    $query->orWhere($column, $search);
                }
            });
            return $this;
        });
    }
}
