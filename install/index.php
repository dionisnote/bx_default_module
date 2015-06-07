<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use M\Mymd\HlpClass;
use Bitrix\Main\Loader;

if (class_exists('m_mymd')) {
    return;
}

class m_mymd extends CModule
{
    /** @var string */
    public $MODULE_ID;

    /** @var string */
    public $MODULE_VERSION;

    /** @var string */
    public $MODULE_VERSION_DATE;

    /** @var string */
    public $MODULE_NAME;

    /** @var string */
    public $MODULE_DESCRIPTION;

    /** @var string */
    public $MODULE_GROUP_RIGHTS;

    /** @var string */
    public $PARTNER_NAME;

    /** @var string */
    public $PARTNER_URI;

    public $MODULEFOLDER;

    public function __construct()
    {
        $path = str_replace("\\", "/", __FILE__);
        $this->MODULEFOLDER = substr($path, 0, strlen($path) - strlen("install/index.php"));

        $this->MODULE_ID = 'm.mymd'; // ВАЖНО ТОЧКА !!!
        // $this->myAutoload();
        $this->MODULE_VERSION = '0.1.0';
        $this->MODULE_VERSION_DATE = '2015-04-03 16:23:14';
        $this->MODULE_NAME = "А МОДУЛЯ";
        // $this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_DESCRIPTION');
        // $this->MODULE_DESCRIPTION = $this->MODULEFOLDER;
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = "Dionis";
        $this->PARTNER_URI = "http://dionisnote.ru";
        $this->MODULE_DESCRIPTION = HlpClass::getModuleDescription();
    }

    private function myAutoload()
    {
        // require use Bitrix\Main\Loader;
        // require $this->MODILE_ID
        // require $this->MODULEFOLDER; /bitrix/modules/module.name/

        $lib = $this->MODULEFOLDER . '/lib/';
        $files = scandir($lib);
        $classes = array();
        // Loader::registerAutoLoadClasses('m.mymd', array(
        //     // no thanks, bitrix, we better will use psr-4 than your class names convention
        //     'M\Mymd\HlpClass' => 'lib/HlpClass.php',
        // ));
        $classname = __CLASS__; //my_class
        $classspaceSrc = explode('_', $classname);  //// array('my', 'class')
        foreach($classspaceSrc as $k => $word)      ////
            $classspaceSrc[$k] = ucfirst($word);    //// array('My', 'Class')
        $classpace = implode('\\', $classspaceSrc) . '\\'; ////
        foreach($files as $k => $file)
        {
            if(is_file($lib . $file) && strpos($file, '.php')!== false)
            {
                $clName = str_replace('.php', '', $file);
                $classes[$classpace . $clName] = 'lib/' . $file; //Array ( [M\Mymd\HlpClass] => lib/HlpClass.php )
            }
        }

        Loader::registerAutoLoadClasses($this->MODULE_ID, $classes);

        return true;

    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        // $this->installDB();
    }

    public function doUninstall()
    {
        // $this->uninstallDB();
        ModuleManager::unregisterModule($this->MODULE_ID);
    }

    public function installDB()
    {
        // if (Loader::includeModule($this->MODULE_ID)) {
        //     ExampleTable::getEntity()->createDbTable();
        // }
    }

    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            // $connection = Application::getInstance()->getConnection();
            // $connection->dropTable(ExampleTable::getTableName());
        }
    }
}
