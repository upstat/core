<?php

/*
 * This file is part of Flarum.
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

return [
    'up' => function (Builder $schema) {
        $schema->table('settings', function (Blueprint $table) {
            $table->binary('new_value')->nullable();
        });

        $schema->getConnection()->table('settings')
            ->update(['new_value' => 'value']);

        $schema->table('settings', function (Blueprint $table) {
            $table->dropColumn('value');
        });

        $schema->table('settings', function (Blueprint $table) {
            $table->renameColumn('new_value', 'value');
        });
    },

    'down' => function (Builder $schema) {
        $schema->table('settings', function (Blueprint $table) {
            $table->text('new_value')->nullable();
        });

        $schema->getConnection()->table('settings')
            ->update(['new_value' => 'value']);

        $schema->table('settings', function (Blueprint $table) {
            $table->dropColumn('value');
        });

        $schema->table('settings', function (Blueprint $table) {
            $table->renameColumn('new_value', 'value');
        });
    }
];
