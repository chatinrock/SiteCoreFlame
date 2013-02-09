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



class eng{

	public function settingsRender($pCont, $pNsPath){
        $num = $pCont->getInt('num');
        $pCont->setVar('num', $num);

        $contData = (new compcontTree())->select('cc.*', 'cc')
            ->join(componentTree::TABLE . ' c', 'c.id=cc.comp_id')
            ->where('c.sysname="objItem" AND cc.isDel="no"')
            ->fetchAll();

        $contTree = dhtmlxTree::all($contData, 0);
        $pCont->setJson('contTreeJson', $contTree);

        $pCont->view->setTplPath(dirFunc::getAdminTplPathOut($pNsPath));
        $pCont->view->setMainTpl('engart/ajax/settings.tpl.php');
		// func. settingsRender
	}

    public function createClassFile($pName, $pCompId, $pData){
        $data = json_decode($pData);
        $data->open = trim($data->open, ',');
        $data->close = trim($data->close, ',');
        return <<<"CODE_STRING"
<?php
    \$data = new \stdClass();
    \$data->open = [{$data->open}];
    \$data->close = [{$data->close}];
    \\site\\core\\site\\comp\\spl\\objItem\\ajax\\eng\\eng::echoArticle($pCompId, \$data);
CODE_STRING;
        // func. createClassFile
    }
	// class eng
}