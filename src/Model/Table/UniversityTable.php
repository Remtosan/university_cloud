<?php
/**
 * Created by PhpStorm.
 * User: luttinger
 * Date: 03/07/18
 * Time: 11:03 AM
 */

namespace App\Model\Table;


use Cake\ORM\Table;

class UniversityTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('Universities');

        $this->setPrimaryKey('University_ID');
    }
}       