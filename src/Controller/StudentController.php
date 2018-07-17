<?php

namespace App\Controller;

use App\ControllerHelpers\StudentControllerHelper;
use Cake\Log\Log;

define("STUDENT_CONTROLLER_NAME_SPACE", "Student");

class StudentController extends GE3PController
{
    public function getAll()
    {
        $result = null;
        try {
            //Variables esperadas por el servicio
            $arrayToBeTested = array();
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, STUDENT_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $studentControllerHelper = new StudentControllerHelper($this);

                $uny = $studentControllerHelper->getAllData();

                $result = parent::setSuccessfulResponseWithObject($result, $uny);
            }
        } catch (\Exception $e) {
            Log::info("Error, " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            $result = parent::setExceptionResponse($result, $e);
        }
        parent::returnAJson($result);
    }

    public function getById()
    {
        $result = null;
        try {
            //Variables esperadas por el servicio
            $arrayToBeTested = array('User_ID');
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, STUDENT_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $jsonObject = $result[WEB_SERVICE_RESPONSE_SIGNATURE]['object'];

                $studentControllerHelper = new StudentControllerHelper($this);

                $id = $studentControllerHelper->getById($jsonObject['User_ID']);

                $result = parent::setSuccessfulResponseWithObject($result, $id);
            }
        } catch (\Exception $e) {
            Log::info("Error, " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            $result = parent::setExceptionResponse($result, $e);
        }
        parent::returnAJson($result);
    }

    public function addStudent()
    {
        $result = null;
        try {
            //Variables esperadas por el servicio
            $arrayToBeTested = array('First_Name','Last_Name','Age','Sex');
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, STUDENT_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $jsonObject = $result[WEB_SERVICE_RESPONSE_SIGNATURE]['object'];

                $studentControllerHelper = new StudentControllerHelper($this);

                $newuser = $studentControllerHelper->addStudent($jsonObject);
                $result = parent::setSuccessfulSaveResponseWithObject($result, $newuser);
            }
        } catch (\Exception $e) {
            Log::info("Error, " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            $result = parent::setExceptionResponse($result, $e);
        }
        parent::returnAJson($result);
    }


    public function deleteStudent()
    {
        $result = null;
        try {
            //Variables esperadas por el servicio
            $arrayToBeTested = array('User_ID');
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, STUDENT_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $jsonObject = $result[WEB_SERVICE_RESPONSE_SIGNATURE]['object'];

                $studentControllerHelper = new StudentControllerHelper($this);

                if($studentControllerHelper->deleteStudent($jsonObject['User_ID']))
                {
                    $code = 0;
                    $message = "DELETED SUCCESSFULLY";
                }
                $result = parent::setResponseWithMessage($result, $code, $message);
            }
        } catch (\Exception $e) {
            Log::info("Error, " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            $result = parent::setExceptionResponse($result, $e);
        }
        parent::returnAJson($result);
    }




}