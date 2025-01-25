<?php

namespace app\core;

use app\core\db\DbModel;

abstract class UserModal extends DbModel
{
    abstract public function getDisplayName(): string;

}