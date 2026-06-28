<?php

namespace NumberNormalizer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use NumberNormalizer\NumberNormalizer;

class NormalizeNumbers
{
    public function __construct(
        protected NumberNormalizer $normalizer
    ) {}

    public function handle(Request $request, Closure $next)
    {
        if ($this->shouldExclude($request)) {
            return $next($request);
        }

        $request->merge(
            $this->normalizeArray($request->all())
        );

        return $next($request);
    }

    protected function shouldExclude(Request $request): bool
    {
        $excluded = config('number-normalizer.except', []);
        $routeName = $request->route()?->getName();
        $path = $request->path();

        foreach ($excluded as $pattern) {
            if (str_contains($pattern, '*')) {
                $regex = '/^'.str_replace('\*', '.*', preg_quote($pattern, '/')).'$/';

                if (preg_match($regex, $path) || ($routeName && preg_match($regex, $routeName))) {
                    return true;
                }

                continue;
            }

            if ($routeName === $pattern || $path === $pattern) {
                return true;
            }
        }

        return false;
    }

    protected function normalizeArray(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = $this->normalizer->toEnglish($value);
            } elseif (is_array($value)) {
                $data[$key] = $this->normalizeArray($value);
            }
        }

        return $data;
    }
}
