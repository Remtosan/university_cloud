<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 26/06/18
 * Time: 12:06 PM
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class PaymentsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('payments');

        $this->setPrimaryKey('payment_id');
    }
}