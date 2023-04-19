<?php
    namespace Kairnial\Common\Providers;

    use Illuminate\Contracts\Container\BindingResolutionException;
    use Illuminate\Contracts\Foundation\CachesConfiguration;
    use Illuminate\Support\ServiceProvider;
    use Illuminate\Support\Arr;

    class BaseServiceProvider extends ServiceProvider
    {
        /**
         * Merges configuration entries with nested keys
         * @throws BindingResolutionException
         */
        public function mergeNestedConfigFrom(string $path, string $key)
        {
            if (! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
                $config = $this->app->make('config');

                $config->set($key, self::merge(
                    $config->get($key, []), require $this->app->basePath($path)
                ));
            }
        }

        /**
         * Merges two arrays and takes multi-dimensional arrays into account.
         * @param array $array1 : the first array
         * @param array $array2 : the second array
         * @return array the merged array
         */
        private static function merge(array $array1, array $array2): array
        {
            $array = array_merge($array1, $array2);

            foreach ($array1 as $key => $value)
            {
                if (is_array($value) === false || Arr::exists($array2, $key) === false || is_integer($key))
                {
                    continue;
                }

                $array[$key] = self::merge($value, $array2[$key]);
            }

            return $array;
        }
    }
