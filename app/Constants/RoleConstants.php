<?php

namespace App\Constants;

class RoleConstants
{
    const ROLE_USER = "ROLE_USER";
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_CONTENT_CREATOR = 'ROLE_CONTENT_CREATOR';

    const ROLE_USER_NAME = 'User';
    const ROLE_ADMIN_NAME = 'Admin';
    const ROLE_CONTENT_CREATOR_NAME = 'Content creator';

    const ROLE_KEYS_TO_NAMES = [
        self::ROLE_USER=>self::ROLE_USER_NAME,
        self::ROLE_ADMIN => self::ROLE_ADMIN_NAME,
        self::ROLE_CONTENT_CREATOR => self::ROLE_CONTENT_CREATOR_NAME
    ];
}
