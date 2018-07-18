<?php
/**
 * Created by PhpStorm.
 * User: luttinger
 * Date: 03/07/18
 * Time: 11:06 AM
 */

namespace App\Controller;

use App\ControllerHelpers\UniversityControllerHelper;
use Cake\Log\Log;

define("UNIVERSITY_CONTROLLER_NAME_SPACE", "Universities");

class UniversityController extends GE3PController
{
    public function getAll()
    {
        $result = null;
        try {
            //Variables esperadas por el servicio
            $arrayToBeTested = array();
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, UNIVERSITY_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $universityControllerHelper = new UniversityControllerHelper($this);

                $uny = $universityControllerHelper->getAllData();

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
            $arrayToBeTested = array('University_ID');
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, UNIVERSITY_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $jsonObject = $result[WEB_SERVICE_RESPONSE_SIGNATURE]['object'];

                $UniversityControllerHelper = new UniversityControllerHelper($this);

                $id = $UniversityControllerHelper->getById($jsonObject['University_ID']);

                $result = parent::setSuccessfulResponseWithObject($result, $id);
            }
        } catch (\Exception $e) {
            Log::info("Error, " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            $result = parent::setExceptionResponse($result, $e);
        }
        parent::returnAJson($result);
    }

    public function addUniversity()
    {
        $result = null;
        try {
            //Variables esperadas por el servicio
            $arrayToBeTested = array('University_Name','Careers');
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, UNIVERSITY_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $jsonObject = $result[WEB_SERVICE_RESPONSE_SIGNATURE]['object'];

                $UniversityControllerHelper = new UniversityControllerHelper($this);

                $newUniversity = $UniversityControllerHelper->addUniversity($jsonObject);

                Log::debug("UNIVERSIDAD: " .json_encode($newUniversity));

                $this->addCareerToUniversity($jsonObject['Careers'], $newUniversity['University_ID']);

                $result = parent::setSuccessfulSaveResponseWithObject($result, $newUniversity);
            }
        } catch (\Exception $e) {
            Log::info("Error, " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            $result = parent::setExceptionResponse($result, $e);
        }
        parent::returnAJson($result);
    }


    public function deleteUniversity()
    {
        $result = null;
        try {
            //Variables esperadas por el servicio
            $arrayToBeTested = array('University_ID');
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, UNIVERSITY_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $jsonObject = $result[WEB_SERVICE_RESPONSE_SIGNATURE]['object'];

                $UniversityControllerHelper = new UniversityControllerHelper($this);

                if($UniversityControllerHelper->deleteUniversity($jsonObject['University_ID']))
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


    private function addCareerToUniversity ($careers, $universityId)
    {
        $UniversityControllerHelper = new UniversityControllerHelper($this);
                foreach ($careers as $id)
                {
                    $UniversityControllerHelper->addCareerToUniversity($id, $universityId);
                }
    }




}