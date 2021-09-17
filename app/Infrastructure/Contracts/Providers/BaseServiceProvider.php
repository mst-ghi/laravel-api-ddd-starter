<?php

namespace App\Infrastructure\Contracts\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;

abstract class BaseServiceProvider extends ServiceProvider
{
    /**
     * @var string Alias for load translations and views
     */
    protected $alias;

    /**
     * @var bool Set if will load commands
     */
    protected $hasCommands = false;

    /**
     * @var bool Set if will load factories
     */
    protected $hasFactories = false;

    /**
     * @var bool Set if will load migrations
     */
    protected $hasMigrations = false;

    /**
     * @var bool Set if will load translations
     */
    protected $hasTranslations = false;

    /**
     * @var bool Set if will load policies
     */
    protected $hasPolicies = false;

    /**
     * @var array List of custom Artisan commands
     */
    protected $commands = [];

    /**
     * @var array List of model factories to load
     */
    protected $factories = [];

    /**
     * @var array List of providers to load
     */
    protected $providers = [];

    /**
     * @var array List of policies to load
     */
    protected $policies = [];

    /**
     * Boot required registering of views and translations.
     *
     * @throws \ReflectionException
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerCommands();
        $this->registerFactories();
        $this->registerMigrations();
        $this->registerTranslations();
    }

    /**
     * Register the application's policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
        if ($this->hasPolicies && config('register.policies')) {
            foreach ($this->policies as $key => $value) {
                Gate::policy($key, $value);
            }
        }
    }

    /**
     * Register domain custom Artisan commands.
     */
    protected function registerCommands()
    {
        if ($this->hasCommands && config('register.commands')) {
            $this->commands($this->commands);
        }
    }

    /**
     * Register Model Factories.
     */
    protected function registerFactories()
    {
        if ($this->hasFactories && config('register.factories')) {
            collect($this->factories)->each(function ($factoryName) {
                (new $factoryName())->define();
            });
        }
    }

    /**
     * Register domain migrations.
     */
    protected function registerMigrations()
    {
        if ($this->hasMigrations && config('register.migrations')) {
            $this->loadMigrationsFrom($this->domainPath('Database/Migrations'));
        }
    }

    /**
     * Detects the domain base path so resources can be proper loaded on child classes.
     *
     * @param string|null $append
     * @return string
     */
    protected function domainPath(string $append = null)
    {
        $reflection = new ReflectionClass($this);

        $realPath = realpath(dirname($reflection->getFileName()) . '/../');

        if (!$append) {
            return $realPath;
        }

        return $realPath . '/' . $append;
    }

    /**
     * Register domain translations.
     */
    protected function registerTranslations()
    {
        if ($this->hasTranslations && config('register.translations')) {
            $this->loadJsonTranslationsFrom($this->domainPath('Resources/Lang'));
        }
    }

    /**
     * Register Domain ServiceProviders.
     */
    public function register()
    {
        collect($this->providers)->each(function ($providerClass) {
            $this->app->register($providerClass);
        });
    }
}
