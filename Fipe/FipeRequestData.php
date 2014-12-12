<?php

namespace Fipe;

class FipeRequestData
{

    private $scriptManager1;
    private $eventTarget;
    private $eventValidation;
    private $viewState;
    private $viewStateGenerator;
    private $ddlMarca = 0;
    private $ddlModelo = 0;
    private $ddlReferenci = 0;
    private $ddlAnoValor = 0;
    
    const SCRIPT_MODELO = 'ScriptManager1|ddlMarca';
    const SCRIPT_ANO_MODELO = 'updModelo|ddlModelo';
    const SCRIPT_ANO_MODELO_FINAL = 'updAnoValor|ddlAnoValor';
    
    
    const EVENT_DDL_MODELO = 'ddlModelo';
    const EVENT_DDL_ANO_MODELO = 'ddlModelo';
    const EVENT_ANO_MODELO_FINAL = 'ddlAnoValor';

    function getScriptManager1()
    {
        return $this->scriptManager1;
    }

    function getEventTarget()
    {
        return $this->eventTarget;
    }

    function getEventValidation()
    {
        return $this->eventValidation;
    }

    function getViewState()
    {
        return $this->viewState;
    }

    function getViewStateGenerator()
    {
        return $this->viewStateGenerator;
    }

    function getDdlMarca()
    {
        return $this->ddlMarca;
    }

    function getDdlModelo()
    {
        return $this->ddlModelo;
    }

    function getDdlReferenci()
    {
        return $this->ddlReferenci;
    }

    function getDdlAnoValor()
    {
        return $this->ddlAnoValor;
    }

    function setScriptManager1($scriptManager1)
    {
        $this->scriptManager1 = $scriptManager1;
    }

    function setEventTarget($eventTarget)
    {
        $this->eventTarget = $eventTarget;
    }

    function setEventValidation($eventValidation)
    {
        $this->eventValidation = $eventValidation;
    }

    function setViewState($viewState)
    {
        $this->viewState = $viewState;
    }

    function setViewStateGenerator($viewStateGenerator)
    {
        $this->viewStateGenerator = $viewStateGenerator;
    }

    function setDdlMarca($ddlMarca)
    {
        $this->ddlMarca = $ddlMarca;
    }

    function setDdlModelo($ddlModelo)
    {
        $this->ddlModelo = $ddlModelo;
    }

    function setDdlReferenci($ddlReferenci)
    {
        $this->ddlReferenci = $ddlReferenci;
    }

    function setDdlAnoValor($ddlAnoValor)
    {
        $this->ddlAnoValor = $ddlAnoValor;
    }

    public function dataToPost(\Fipe\FormViewState $formViewState)
    {
        $this->setViewState($formViewState->viewState);
        $this->setViewStateGenerator($formViewState->viewStateGgenerator);
        $this->setEventValidation($formViewState->eventValidation);

        if (!$this->eventTarget) {
            throw new \Exception('O evento alvo não foi setado');
        }

        if (!$this->scriptManager1) {
            throw new \Exception('O scriptmanager1 não foi configurado');
        }

        return $this->_toArray();
    }

    private function _toArray()
    {
        return array(
            'ScriptManager1' => $this->getScriptManager1(),
            '__EVENTTARGET' => $this->getEventTarget(),
            '__EVENTVALIDATION' => $this->getEventValidation(),
            '__VIEWSTATE' => $this->getViewState(),
            '__VIEWSTATEGENERATOR' => $this->getViewStateGenerator(),
            'ddlMarca' => $this->getDdlMarca(),
            'ddlModelo' => $this->getDdlModelo(),
            'ddlAnoValor' => $this->getDdlAnoValor()
        );
    }

}
