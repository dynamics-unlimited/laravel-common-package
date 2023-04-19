<?php
    namespace Kairnial\Common\Models\Enums;

    /**
     * Response status enumeration
     */
    enum ApiResponseStatus: string
    {
        case SUCCESS = 'success'; // success
        case ERROR = 'error';     // error
    }
