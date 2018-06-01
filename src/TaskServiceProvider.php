<?php

namespace Viviniko\Task;

use Viviniko\Task\Console\Commands\TaskTableCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class TaskServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/../config/task.php' => config_path('task.php'),
        ]);

        // Register commands
        $this->commands('command.task.table');

        $this->app->resolving(\Illuminate\Console\Scheduling\Schedule::class, function ($schedule) {
            $this->app->make(\Viviniko\Task\Contracts\TaskService::class)->schedule($schedule);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/task.php', 'task');

        $this->registerRepositories();

        $this->registerTaskService();

        $this->registerCommands();
    }

    public function registerRepositories()
    {
        $this->app->singleton(
            \Viviniko\Task\Repositories\Task\TaskRepository::class,
            \Viviniko\Task\Repositories\Task\EloquentTask::class
        );

        $this->app->singleton(
            \Viviniko\Task\Repositories\Log\LogRepository::class,
            \Viviniko\Task\Repositories\Log\EloquentLog::class
        );
    }

    /**
     * Register the artisan commands.
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->app->singleton('command.task.table', function ($app) {
            return new TaskTableCommand($app['files'], $app['composer']);
        });
    }

    /**
     * Register the task service provider.
     *
     * @return void
     */
    protected function registerTaskService()
    {
        $this->app->singleton(\Viviniko\Task\Contracts\TaskCommandManager::class, function ($app) {
            $config = $app['config'];
            return new \Viviniko\Task\Services\ConfigTaskCommandManager($config->get('task.commands', []));
        });

        $this->app->singleton('task', \Viviniko\Task\Services\TaskServiceImpl::class);
        $this->app->alias('task', \Viviniko\Task\Contracts\TaskService::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'task',
            \Viviniko\Task\Contracts\TaskService::class,
        ];
    }
}