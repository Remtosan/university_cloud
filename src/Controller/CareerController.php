<?php

namespace App\Controller;

use App\ControllerHelpers\CareerControllerHelper;
use Cake\Log\Log;

define("CAREER_CONTROLLER_NAME_SPACE", "Career");

class CareerController extends GE3PController
{
    public function getAll()
    {
        $result = null;
        try {
            //Variables esperadas por el servicio
            $arrayToBeTested = array();
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, CAREER_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $careerControllerHelper = new CareerControllerHelper($this);

                $uny = $careerControllerHelper->getAllData();

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
            $arrayToBeTested = array('Career_ID');
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, CAREER_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $jsonObject = $result[WEB_SERVICE_RESPONSE_SIGNATURE]['object'];

                $careerControllerHelper = new CareerControllerHelper($this);

                $id = $careerControllerHelper->getById($jsonObject['Career_ID']);

                $result = parent::setSuccessfulResponseWithObject($result, $id);
            }
        } catch (\Exception $e) {
            Log::info("Error, " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            $result = parent::setExceptionResponse($result, $e);
        }
        parent::returnAJson($result);
    }

    public function addCareer()
    {
        $result = null;
        try {
            //Variables esperadas por el servicio
            $arrayToBeTested = array('Career_Name');
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, CAREER_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $jsonObject = $result[WEB_SERVICE_RESPONSE_SIGNATURE]['object'];

                $careerControllerHelper = new CareerControllerHelper($this);

                $newuser = $careerControllerHelper->addCareer($jsonObject);
                $result = parent::setSuccessfulSaveResponseWithObject($result, $newuser);
            }
        } catch (\Exception $e) {
            Log::info("Error, " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            $result = parent::setExceptionResponse($result, $e);
        }
        parent::returnAJson($result);
    }


    public function deleteCareer()
    {
        $result = null;
        try {
            //Variables esperadas por el servicio
            $arrayToBeTested = array('Career_ID');
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, CAREER_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $jsonObject = $result[WEB_SERVICE_RESPONSE_SIGNATURE]['object'];

                $careerControllerHelper = new CareerControllerHelper($this);

                if($careerControllerHelper->deleteCareer($jsonObject['Career_ID']))
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