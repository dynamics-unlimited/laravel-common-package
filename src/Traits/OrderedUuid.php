<?php
    namespace Kairnial\Common\Traits;

    use Illuminate\Support\Str;

    trait OrderedUuid
    {
        protected static function boot(): void
        {
            // Boot other traits on the Model
            /** @noinspection RedundantSuppression */
            /** @noinspection PhpMultipleClassDeclarationsInspection */
            parent::boot();

            /**
             * Listen for the 'creating' event on the Track Model.
             * Sets the 'id' to a UUID using Str::orderedUuid() on the instance being created
             */
            static::creating(function ($model) {
                // Check if the primary key doesn't have a value
                if (!$model->getKey()) {
                    // Dynamically set the primary key
                    $model->setAttribute($model->getKeyName(), Str::orderedUuid()->toString());
                }
            });
        }

        // Tells Eloquent Model not to auto-increment this field
        public function getIncrementing(): bool
        {
            return false;
        }

        // Tells that the IDs on the table should be stored as strings
        public function getKeyType(): string
        {
            return 'string';
        }
    }
