<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Introduction extends DataLayer
{
    public function __construct()
    {
        parent::__construct("introductions", ["description"]);
    }
}