<?php

/*
 * This file is part of Flarum.
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->rename('auth_tokens', 'registration_tokens');
    },

    'down' => function (Builder $schema) {
        $schema->rename('registration_tokens', 'auth_tokens');
    }
];
