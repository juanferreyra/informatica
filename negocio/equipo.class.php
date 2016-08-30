<?php
include_once 'componente.class.php';
include_once 'sector.class.php';

class equipo {
    var $id;
    var $detalle;
    var $sector;
    var $componentes;

    public function equipo(){
        $this->componentes = array();
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setDetalle($detalle){
        $this->detalle = $detalle;
    }

    public function setSector(Sector $sector){
        $this->sector = $sector;
    }

    public function getId(){
        return $this->id;
    }

    public function getDetalle(){
        return $this->detalle;
    }

    public function getSector(){
        return $this->sector;
    }

    public function agregarComponente(Componente $item){
        $this->componentes[] = $item;
    }

    public function getComponentes(){
        return $this->componentes;
    }
}