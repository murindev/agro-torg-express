<?php

namespace App\Providers;

use App\Http\ViewComposers\AdsCatalog;
use App\Http\ViewComposers\CatalogAsideAds;
use App\Http\ViewComposers\CatalogAsideNews;
use App\Http\ViewComposers\CatalogAsideVip;
use App\Http\ViewComposers\MainSearchBar;
use App\Http\ViewComposers\RubricatorCounter;
use App\Http\ViewComposers\TopFilter;
use App\Models\Ads\AdCategories;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.mainSearchBar',MainSearchBar::class);
        view()->composer('partials.rubricatorCounter',RubricatorCounter::class);
        view()->composer('partials.topFilter',TopFilter::class);
        // aside
        view()->composer('partials.catalogAsideVip',CatalogAsideVip::class);
        view()->composer('partials.catalogAsideNews',CatalogAsideNews::class);
        view()->composer('partials.catalogAsideAds',CatalogAsideAds::class);
    }
}
