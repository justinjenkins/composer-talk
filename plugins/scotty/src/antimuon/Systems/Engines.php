<?php

	namespace antimuon\Systems;
	
	use antimuon\Crew\Scotty as Scotty;
	
	class Engines {
		
		public $warpFactor;
		public $onFire;
		
		private $maxWarpFactor = 10;
		
		public function __construct() {
			$this->warpFactor = 0;
			$this->onFire = false;
		}
		
		public function setWarpFactor($factor) {
			
			if (!is_numeric($factor)) {
				return Scotty::rephrase();
			}
			
			if ($factor > $this->maxWarpFactor) {
				return "Warp Factor {$factor}?! " . Scotty::cannae();
			}
			
			if ($this->warpFactor <= 9.999) {
				$this->warpFactor = $factor;
			} else {
				return Scotty::exclaim();
			}
			
			return "Warp Factor {$this->warpFactor}, Aye.";
			
		}
		
		public function increasePower() {
			
			return $this->setWarpFactor($this->warpFactor + 1);
			
		}
		
		public function status() {
			
			if ($this->onFire) {
				return "Ahhhhhhhhh! Everything is on fire!!!";
			}
			
			return "Engines running within acceptable parameters";
			
		}
		
	}