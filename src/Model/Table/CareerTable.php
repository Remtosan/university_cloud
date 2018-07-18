<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class CareerTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('career');

        $this->setPrimaryKey('Career_ID');
    }
}