<?php

namespace App\Model\Table;


use Cake\ORM\Table;

class StudentTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('students');

        $this->setPrimaryKey('User_ID');
    }
}