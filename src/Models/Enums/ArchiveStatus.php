<?php
    namespace Kairnial\Common\Models\Enums;

    /**
     * Language codes enumeration
     */
    enum ArchiveStatus: int
    {
        case Active = 0;
        case Archived = 1;

        public function name(): string
        {
            return match ($this)
            {
                self::Active   => 'active',
                self::Archived => 'archived',
            };
        }
    }
