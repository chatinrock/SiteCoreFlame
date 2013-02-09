<?
namespace site\core\admin\comp\spl\objItem\ajax\eng;

// Engine
use core\classes\render;
use core\classes\mvc\controllerAbstract;
use core\classes\filesystem;
use core\classes\admin\dirFunc;

// ORM
use ORM\tree\componentTree;
use ORM\tree\compContTree;

// Plugin
use admin\library\mvc\plugin\dhtmlx\model\tree as dhtmlxTree;



class sendRecord{

	public function settingsRender($pCont, $pNsPath){
        $pCont->view->setRenderType(render::NONE);
		// func. settingsRender
	}

    public function createClassFile($pName, $pCompId, $pData){
        return <<<"CODE_STRING"
<?php
    \\site\\core\\site\\comp\\spl\\objItem\\ajax\\eng\\sendRecord::saveData();
CODE_STRING;
        // func. createClassFile
    }
	// class eng
}