<?php

namespace Fipe;

use Fipe\FipeSocket as Socket;
use Fipe\Parser;
use Fipe\Extractor;
use Fipe\FormViewState;
use Fipe\FipeRequestData;

class Fipe
{
    const URL_BASE = 'fipe.org.br';
    const PATH_BASE = '/web/indices/veiculos/default.aspx?';

    const CARROS = 'azxp=1&azxp=1&p=51';
    const MOTOS = 'v=m&p=52';
    const CAMINHOES = 'v=c&p=53';

    private $path = null;

    /**
     * @var this variable store of state this request;
     */
    protected $formViewState;

    /**
     * Méthod construct
     */
    public function __construct($typeVeiculo)
    {
        $this->path = Fipe::PATH_BASE.$typeVeiculo;
        $this->formViewState = new FormViewState();
    }

    /**
     * Métod return a list of Brands
     * @return \SplObjectStorage
     */
    public function marcas()
    {   
        $responseTrends = Socket::get(Fipe::URL_BASE, $this->path);
        $domDocument = Parser::toDomDocument($responseTrends);
        $this->formViewState->initialize($domDocument);
        $listOfBrands = Extractor::fromTagSelect(new \SplObjectStorage(), 'ddlMarca', $domDocument);

        return $listOfBrands;
    }

    /**
     * Method return a list of Models
     * @param Integer $marcaID
     * @return \SplObjectStorage
     * 
     * @throws Exception
     */
    public function modelos($marcaID)
    {
        $this->_validateFormViewState();
              
        $request = new FipeRequestData();
        $request->setDdlMarca($marcaID);
        $request->setScriptManager1(FipeRequestData::SCRIPT_MODELO);
        $request->setEventTarget(FipeRequestData::EVENT_DDL_MODELO);
        $dataToPost = $request->dataToPost($this->formViewState);
        
        $responseModels = Socket::post(Fipe::URL_BASE, $this->path, $dataToPost);
        $domDocument = Parser::toDomDocument($responseModels);
        $this->formViewState->initialize($domDocument);
        $listOfModels = Extractor::fromTagSelect(new \SplObjectStorage(), 'ddlModelo', $domDocument);
        
        return $listOfModels;
    }
   
    /**
     * Method return a list of AnoModelo
     * @param Integer $marcaID
     * @param Integer $modeloID
     * @return \SplObjectStorage
     * 
     * @throws Exception
     */
    public function anoModelo($marcaID, $modeloID){
        $this->_validateFormViewState();
              
        $request = new FipeRequestData();
        $request->setDdlMarca($marcaID);
        $request->setDdlModelo($modeloID);
        $request->setScriptManager1(FipeRequestData::SCRIPT_ANO_MODELO);
        $request->setEventTarget(FipeRequestData::EVENT_DDL_ANO_MODELO);
        $dataToPost = $request->dataToPost($this->formViewState);
        
        $responseModels = Socket::post(Fipe::URL_BASE, $this->path, $dataToPost);
        $domDocument = Parser::toDomDocument($responseModels);
        $this->formViewState->initialize($domDocument);
        $lisOfAnoModelo = Extractor::fromTagSelect(new \SplObjectStorage(), 'ddlAnoValor', $domDocument);
        
        return $lisOfAnoModelo;
    }
    
    /**
     * Method return a cotation of vehicle
     * @param Integer $marcaID
     * @param Integer $modeloID
     * @param Integer $anoModeloID
     * @return array
     * 
     * @throws Exception
     */
    public function anoModeloCotacao($marcaID, $modeloID, $anoModeloID){
        $this->_validateFormViewState();
        
        $request = new FipeRequestData();
        $request->setDdlMarca($marcaID);
        $request->setDdlModelo($modeloID);
        $request->setDdlAnoValor($anoModeloID);
        $request->setScriptManager1(FipeRequestData::SCRIPT_ANO_MODELO_FINAL);
        $request->setEventTarget(FipeRequestData::EVENT_ANO_MODELO_FINAL);
        $dataToPost = $request->dataToPost($this->formViewState);
        
        $responseCotacao = Socket::post(Fipe::URL_BASE, $this->path, $dataToPost);
        $domDocument = Parser::toDomDocument($responseCotacao);
        $contacao = Extractor::cotation($domDocument);

        return $contacao;
    }
    
    /**
     * Método check if exist the objet represent the view scope
     * @throws Exception
     */
    private function _validateFormViewState(){
        if(!$this->formViewState){
            throw new Exception('É necessário completar o ciclo de requisição se iniciando em marcas');
        }
    }

}
