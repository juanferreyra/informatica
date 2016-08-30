<?php
include_once 'tipoComponente.class.php';

class Componente {
    var $id;
    var $detalle;
    var $tipo_componente;

    public function Componente(){
        $this->tipo_componente = new TipoComponente();
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setDetalle($detalle){
        $this->detalle = $detalle;
    }

    public function setTipoComponente(TipoComponente $tipo){
        $this->tipo_componente = $tipo;
    }

    public function getId(){
        return $this->id;
    }

    public function getDetalle(){
        return $this->detalle;
    }

    public function getTipoComponente(){
        return $this->tipo_componente;
    }
}