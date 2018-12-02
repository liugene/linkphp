<?php

namespace app\http\model;

use framework\Model;

class Home extends Model
{

    protected $field = ['id'];

    protected $name = 'forum';

    protected $updateTime = 'post_time';

    protected $createTime = 'up_time';

}