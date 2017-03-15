<?php
	
	namespace antimuon;
	
	use Composer\Composer;
	use Composer\IO\IOInterface;
	use Composer\Plugin\PluginInterface;
	
	class Plugin implements PluginInterface {
		
		public function activate(Composer $composer, IOInterface $io) {
			echo "\n*** Hello World. ***\n\n";
		}
		
	}
	
?>