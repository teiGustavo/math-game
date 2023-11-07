<?php

namespace MathGame\Models;

use CoffeeCode\DataLayer\DataLayer;

class Game extends DataLayer
{
    /**
    * Game constructor.
    */
    public function __construct()
    {
        parent::__construct("games", ["nome", "telefone"], 'id', false);
    }
}