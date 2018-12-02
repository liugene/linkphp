<?php

namespace app\http\model;

use framework\Model;

class Home extends Model
{

    protected $field = ['id', 'title', 'c_id', 'post_time', 'up_time', 'is_on'];

    protected $name = 'forum';

    protected $updateTime = 'post_time';

    protected $createTime = 'up_time';

}