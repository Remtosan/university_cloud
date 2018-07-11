<?php
/**
 * Created by PhpStorm.
 * User: luttinger
 * Date: 03/07/18
 * Time: 11:06 AM
 */

namespace App\Controller;

use App\ControllerHelpers\LolControllerHelper;
use Cake\Log\Log;

define("LOL_CONTROLLER_NAME_SPACE", "Lol");

class LolController extends GE3PController
{
    public function getAll()
    {
        $result = null;
        try {
            //Variables esperadas por el servicio
            $arrayToBeTested = array();
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, LOL_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $lolControllerHelper = new LolControllerHelper($this);

                $lols = $lolControllerHelper->getAllData();

                $result = parent::setSuccessfulResponseWithObject($result, $lols);
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
            $arrayToBeTested = array('CI');
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, LOL_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $jsonObject = $result[WEB_SERVICE_RESPONSE_SIGNATURE]['object'];

                $LolControllerHelper = new LolControllerHelper($this);

                $ci = $LolControllerHelper->getById($jsonObject['CI']);

                $result = parent::setSuccessfulResponseWithObject($result, $ci);
            }
        } catch (\Exception $e) {
            Log::info("Error, " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            $result = parent::setExceptionResponse($result, $e);
        }
        parent::returnAJson($result);
    }

    public function addUser()
    {
        $result = null;
        try {
            //Variables esperadas por el servicio
            $arrayToBeTested = array('firstname', 'lastname','age','id');
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, LOL_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $jsonObject = $result[WEB_SERVICE_RESPONSE_SIGNATURE]['object'];

                $LolControllerHelper = new LolControllerHelper($this);

                $newuser = $LolControllerHelper->addUser($jsonObject);
                $result = parent::setSuccessfulSaveResponseWithObject($result, $newuser);
            }
        } catch (\Exception $e) {
            Log::info("Error, " . __FUNCTION__ . " cause: " . $e->getMessage());
            Log::error(__FUNCTION__, $e);
            $result = parent::setExceptionResponse($result, $e);
        }
        parent::returnAJson($result);
    }

    public function deleteUser()
    {
        $result = null;
        try {
            //Variables esperadas por el servicio
            $arrayToBeTested = array('id');
            $result = parent::runWebServiceInitialConfAndValidations($arrayToBeTested, LOL_CONTROLLER_NAME_SPACE, __FUNCTION__);
            if (parent::isASuccessfulResult($result[WEB_SERVICE_RESPONSE_SIGNATURE])) {

                $jsonObject = $result[WEB_SERVICE_RESPONSE_SIGNATURE]['object'];

                $LolControllerHelper = new LolControllerHelper($this);

                if($LolControllerHelper->deleteUser($jsonObject['id']))
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