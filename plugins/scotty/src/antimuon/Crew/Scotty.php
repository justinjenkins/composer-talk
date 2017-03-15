<?php
	
	namespace antimuon\Crew;
	
	class Scotty extends CrewMember {
		
		public function __construct() {
			$this->name = "Scotty";
			$this->location = "Engineering";
		}
		
		public static function exclaim () {
			return "I've giv'n her all she's got captain, an' I canna give her no more.";
		}
		
		public static function rephrase(){
			return "Laddy, don't you think you should ... rephrase that??";
		}
		
		public static function cannae() {
			return "I cannae change the laws of physics, Captain!";
		}
		
	}