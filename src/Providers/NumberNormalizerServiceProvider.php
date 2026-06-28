<?php

namespace NumberNormalizer\Providers;

use Illuminate\Support\ServiceProvider;
use NumberNormalizer\Http\Middleware\NormalizeNumbers;
use NumberNormalizer\NumberNormalizer;

class NumberNormalizerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/number-normalizer.php', 'number-normalizer');

        $this->app->singleton(NumberNormalizer::class, function () {
            return new NumberNormalizer();
        });

        $this->app->alias(NumberNormalizer::class, 'number-normalizer');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/number-normalizer.php' => config_path('number-normalizer.php'),
        ], 'number-normalizer-config');

        $this->app['router']->aliasMiddleware('normalize.numbers', NormalizeNumbers::class);

        if (config('number-normalizer.auto_middleware', true)) {
            $kernel = $this->app->make(\Illuminate\Contracts\Http\Kernel::class);

            if (method_exists($kernel, 'pushMiddleware')) {
                $kernel->pushMiddleware(NormalizeNumbers::class);
            }
        }
    }
}
