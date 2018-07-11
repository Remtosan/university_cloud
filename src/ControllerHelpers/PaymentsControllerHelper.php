<?php
/**
 * Created by PhpStorm.
 * User: javier
 * Date: 26/06/18
 * Time: 02:20 PM
 */

namespace App\ControllerHelpers;

use App\Controller\GE3PController;
use Cake\Core\Exception\Exception;
use Cake\I18n\Date;
use Cake\Log\Log;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use DateTime;

class PaymentsControllerHelper
{
    private $GE3PController;
    function __construct(GE3PController $GE3PController)
    {
        $this->GE3PController = $GE3PController;
    }

    public function getAllPayments()
    {
        $result = null;
        try {
            $paymentsTable = TableRegistry::get("Payments");
            $queryResult = $paymentsTable->find();

            if (!$this->GE3PController->isTheCursorEmpty($queryResult)) {
                $result = $queryResult->toArray();
            } else {
                throw new \Exception("No payments found");
            }
        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
        return $result;
    }


    public function getById($paymentId)
    {
        $result = null;
        try {

            $paymentsTable = TableRegistry::get("Payments");
            $queryResult = $paymentsTable->find()
                ->where(array('payment_id' => $paymentId));

            if (!$this->GE3PController->isTheCursorEmpty($queryResult)) {
                $result = $queryResult->toArray();
            } else {
                throw new \Exception("No payments found");
            }
        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
        return $result;
    }

    public function save($object)
    {
        try
        {
            $paymentsTable = TableRegistry::get("Payments");
            $paymentObject = $paymentsTable->newEntity();

            $paymentObject->user_id = $object['user_id'];
            $paymentObject->payment_amount = $object['payment_amount'];
            $paymentObject->payment_status_id = $object['payment_status_id'];
            $paymentObject->item_id = $object['item_id'];
            $paymentObject->payment_date = new DateTime();
            $paymentObject->payment_number = $object['payment_number'];

            $savedObject = $paymentsTable->save($paymentObject);
            return $savedObject;

        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
    }

    public function updatePaymentStatus($object)
    {
        try
        {
            $paymentsTable = TableRegistry::get("Payments");
            $paymentObject = $paymentsTable->newEntity();

            $paymentObject->payment_id = $object['payment_id'];
            $paymentObject->payment_status_id = $object['payment_status_id'];

            $savedObject = $paymentsTable->save($paymentObject);
            return $savedObject;

        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
    }
}