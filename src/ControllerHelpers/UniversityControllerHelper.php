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

class UniversityControllerHelper
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
            $universitiesTable = TableRegistry::get("Universities");
            $queryResult = $universitiesTable->find();

            if (!$this->GE3PController->isTheCursorEmpty($queryResult)) {
                $result = $queryResult->toArray();
            } else {
                throw new \Exception("No Universities found");
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

            $universitiesTable = TableRegistry::get("Universities");
            $queryResult = $universitiesTable->find()
                ->where(array('University_ID' => $ID));

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

    public function addUniversity($object)
    {
        try
        {
            $universitiesTable = TableRegistry::get("Universities");
            $universityObject = $universitiesTable->newEntity();

            if(isset($object['University_ID']))
            {
                $universityObject->University_ID = $object['University_ID'];
            }
            $universityObject->University_Name = $object['University_Name'];

            $savedObject = $universitiesTable->save($universityObject);
            return $savedObject;

        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteUniversity($id)
    {
        try
        {
            $universitiesTable = TableRegistry::get("Universities");
            $universitiesTable->deleteAll(array("University_ID" => $id));
            return true;

        } catch (\Exception $e) {
            Log::info("Error en " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            throw new \Exception($e->getMessage());
        }
    }








}

