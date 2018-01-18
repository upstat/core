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
        $schema->table('notifications', function (Blueprint $table) {
            $table->dropColumn('sender_id', 'subject_type');

            $table->renameColumn('time', 'created_at');
            $table->renameColumn('is_read', 'read_at');
            $table->renameColumn('is_deleted', 'deleted_at');
        });
    },

    'down' => function (Builder $schema) {
        $schema->table('notifications', function (Blueprint $table) {
            $table->integer('sender_id')->unsigned()->nullable();
            $table->string('subject_type', 200)->nullable();

            $table->renameColumn('created_at', 'time');
            $table->renameColumn('read_at', 'is_read');
            $table->renameColumn('deleted_at', 'is_deleted');
        });
    }
];
