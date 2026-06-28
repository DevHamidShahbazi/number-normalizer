<?php

namespace NumberNormalizer;

class NumberNormalizer
{
    protected array $mergedMapping = [];

    public function __construct()
    {
        $this->mergedMapping = $this->buildMapping(
            config('number-normalizer.combined_languages', [])
        );
    }

    /**
     * Convert digits in a string to English using active languages from config.
     */
    public function toEnglish(string $string, ?array $languages = null): string
    {
        if ($string === '') {
            return $string;
        }

        $mapping = $languages !== null
            ? $this->buildMapping($languages)
            : $this->mergedMapping;

        return $mapping !== [] ? strtr($string, $mapping) : $string;
    }

    /**
     * Convert using a custom mapping (independent of config).
     */
    public function withMapping(string $string, array $mapping): string
    {
        if ($string === '' || $mapping === []) {
            return $string;
        }

        return strtr($string, $mapping);
    }

    /**
     * Get the current merged mapping.
     */
    public function getMergedMapping(): array
    {
        return $this->mergedMapping;
    }

    /**
     * Get all registered mappings (built-in + custom).
     */
    public function getAllMappings(): array
    {
        return array_merge(
            config('number-normalizer.mappings', []),
            config('number-normalizer.custom_mappings', [])
        );
    }

    protected function buildMapping(array $languages): array
    {
        $allMappings = $this->getAllMappings();
        $merged = [];

        foreach ($languages as $language) {
            if (isset($allMappings[$language])) {
                $merged = array_merge($merged, $allMappings[$language]);
            }
        }

        return $merged;
    }
}
