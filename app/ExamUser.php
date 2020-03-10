<?php
/**
 * Copyright (c) 2019.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamUser
 *
 * @package App
 * @property string $title
 * @property string $created_by
 * @property string $updated_by
 */
class ExamUser extends Model
{
    protected $table = 'exam_user';

}
