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
        $schema->table('tags', function (Blueprint $table) {
            $table->renameColumn('discussions_count', 'discussion_count');
            $table->renameColumn('last_time', 'last_posted_at');
            $table->renameColumn('last_discussion_id', 'last_posted_discussion_id');
            $table->integer('post_count')->unsigned();
            $table->integer('last_posted_user_id')->unsigned();
        });
    },

    'down' => function (Builder $schema) {
        $schema->table('tags', function (Blueprint $table) {
            $table->renameColumn('discussion_count', 'discussions_count');
            $table->renameColumn('last_posted_at', 'last_time');
            $table->renameColumn('last_posted_discussion_id', 'last_discussion_id');
            $table->dropColumn('post_count', 'last_posted_user_id');
        });
    }
];
