<?php
class Bootstrap extends Yaf_Bootstrap_Abstract {
	public function _initPlugin(Yaf_Dispatcher $dispatcher) {
	
		/**
		 * register a plugin
		 */
		$tms = new TmsPlugin();
		$dispatcher->registerPlugin($tms);
		
	}
	
	public function _initSmarty(Yaf_Dispatcher $dispatcher) {
	    
	    $app_path = APP_PATH.'/app/'.MODULE;
	    $config  = new Yaf_Config_Ini(APP_PATH.'/conf/smarty.ini',MODULE);
	    $smarty = new Smarty_Adapter ( $app_path.'/smarty/template', $config->toArray());
	    $dispatcher->setView ( $smarty );
	}
}

