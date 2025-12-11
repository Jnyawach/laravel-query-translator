<?php

namespace Nyawach\LaravelQueryTranslator;
use Illuminate\Support\ServiceProvider;
use Nyawach\LaravelQueryTranslator\Builder\BaseHandler;
use Nyawach\LaravelQueryTranslator\Schema\SchemaReaderFactory;

class QueryTranslatorProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/query-translator.php', 'query-translator');

        $this->app->singleton('schema-reader', function ($app) {
            $config = $app['config']->get('query-translator');
            return (new SchemaReaderFactory())->make();
        });

        $this->app->singleton('query-translator', function ($app){
            return new BaseHandler();
        });

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/query-translator.php' => config_path('query-translator.php'),
        ], 'config');

    }
}
