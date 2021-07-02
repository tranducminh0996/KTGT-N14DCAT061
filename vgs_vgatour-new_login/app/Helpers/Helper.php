<?php
namespace App\Helpers;

class Helper {
    const CODE_SUCCESS = 1;
    const CODE_FAIL = 0;

    const HTTP_OK = 200;
    const HTTP_NOT_FOUND = 404;
    const HTTP_FORBIDDEN = 403;
    const HTTP_SERVE_ERROR = 500;
    const HTTP_UNPROCESSABLE_ENTITY = 422;

    const MESSAGE_SUCCESS = 'message_success';

    const LANG_VI = 1;
    const LANG_EN = 2;
    const LANGUAGES = [
        self::LANG_VI => 'vi',
        self::LANG_EN => 'en',
    ];
}
