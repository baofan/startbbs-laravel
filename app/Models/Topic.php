<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Topic
 *
 * @mixin \Eloquent
 */
class Topic extends Model
{
    protected $table = 'topics';

    // 关闭时间戳
    public $timestamps = false;

}
