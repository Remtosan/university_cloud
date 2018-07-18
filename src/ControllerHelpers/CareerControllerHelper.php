<?php

namespace App\ControllerHelpers;

use App\Controller\GE3PController;
use Cake\Core\Exception\Exception;
use Cake\I18n\Date;
use Cake\Log\Log;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use DateTime;

class CareerControllerHelper
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
            $careersTable = TableRegistry::get("career");
            $queryResult = $careersTable->find();

            if (!$this->GE3PController->isTheCursorEmpty($queryResult)) {
                $result = $queryResult->toArray();
            } else {
                throw new \Exception("No Career found");
            }
        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
        return $result;
    }


    public function getById($ID)
    {
        $result = null;
        try {

            $careersTable = TableRegistry::get("career");
            $queryResult = $careersTable->find()
                ->where(array('Career_ID' => $ID));

            if (!$this->GE3PController->isTheCursorEmpty($queryResult)) {
                $result = $queryResult->toArray();
            } else {
                throw new \Exception("No ID found");
            }
        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
        return $result;
    }

    public function addCareer($object)
    {
        try
        {
            $careersTable = TableRegistry::get("career");
            $careerObject = $careersTable->newEntity();

            if(isset($object['Career_ID']))
            {
                $careerObject->Career_ID = $object['Career_ID'];
            }
            $careerObject->Career_Name = $object['Career_Name'];

            $savedObject = $careersTable->save($careerObject);
            return $savedObject;

        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteCareer($id)
    {
        try
        {
            $universitiesTable = TableRegistry::get("career");
            $universitiesTable->deleteAll(array("Career_ID" => $id));
            return true;

        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
    }
}