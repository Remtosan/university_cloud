<?php
/**
 * Created by PhpStorm.
 * User: luttinger
 * Date: 03/07/18
 * Time: 11:10 AM
 */

namespace App\ControllerHelpers;

use App\Controller\GE3PController;
use Cake\Core\Exception\Exception;
use Cake\I18n\Date;
use Cake\Log\Log;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use DateTime;

class LolControllerHelper
{
    private $GE3PController;
    function __construct(GE3PController $GE3PController)
    {
        $this->GE3PController = $GE3PController;
    }

    public function getAllData()
    {
        $result = null;
        try {
            $lolTable = TableRegistry::get("lol");
            $queryResult = $lolTable->find();

            if (!$this->GE3PController->isTheCursorEmpty($queryResult)) {
                $result = $queryResult->toArray();
            } else {
                throw new \Exception("No lol found");
            }
        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
        return $result;
    }


    public function getById($CI)
    {
        $result = null;
        try {

            $lolTable = TableRegistry::get("lol");
            $queryResult = $lolTable->find()
                ->where(array('CI' => $CI));

            if (!$this->GE3PController->isTheCursorEmpty($queryResult)) {
                $result = $queryResult->toArray();
            } else {
                throw new \Exception("No CI found");
            }
        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
        return $result;
    }

    public function addUser($object)
    {
        try
        {
            $lolsTable = TableRegistry::get("lol");
            $LolObject = $lolsTable->newEntity();
            $LolObject->CI = $object['id'];
            $LolObject->FirstName = $object['firstname'];
            $LolObject->LastName = $object['lastname'];
            $LolObject->Age = $object['age'];

            $savedObject = $lolsTable->save($LolObject);
            return $savedObject;

        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteUser($id)
    {
        try
        {
            $lolsTable = TableRegistry::get("lol");
            $lolsTable->deleteAll(array("CI" => $id));
            return true;

        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
    }








}

