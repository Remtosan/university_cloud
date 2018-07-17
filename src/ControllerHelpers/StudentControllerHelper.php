<?php

namespace App\ControllerHelpers;

use App\Controller\GE3PController;
use Cake\Core\Exception\Exception;
use Cake\I18n\Date;
use Cake\Log\Log;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use DateTime;

class StudentControllerHelper
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
            $studentsTable = TableRegistry::get("students");
            $queryResult = $studentsTable->find();

            if (!$this->GE3PController->isTheCursorEmpty($queryResult)) {
                $result = $queryResult->toArray();
            } else {
                throw new \Exception("No Students found");
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

            $studentsTable = TableRegistry::get("students");
            $queryResult = $studentsTable->find()
                ->where(array('User_ID' => $ID));

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

    public function addStudent($object)
    {
        try
        {
            $studentsTable = TableRegistry::get("students");
            $studentObject = $studentsTable->newEntity();

            if(isset($object['User_ID']))
            {
                $studentObject->User_ID = $object['User_ID'];
            }
            $studentObject->First_Name = $object['First_Name'];

            $studentObject->Last_Name = $object['Last_Name'];

            $studentObject->Age = $object['Age'];

            $studentObject->Sex = $object['Sex'];

            $savedObject = $studentsTable->save($studentObject);
            return $savedObject;

        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteStudent($id)
    {
        try
        {
            $universitiesTable = TableRegistry::get("students");
            $universitiesTable->deleteAll(array("User_ID" => $id));
            return true;

        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
    }








}