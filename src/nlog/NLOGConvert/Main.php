<?php

namespace nlog\NLOGConvert;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{

	public function onEnable() {
		
		@mkdir($this->getDataFolder());
		
		$i = 1;
		
		while ($i < 40) {
			
			$yml = yaml_parse_file($this->getDataFolder()."lands/".$i.".yml");
			
			$convertedData = [ ];
			$convertedData [$i] = [ 
							"id" => $yml ["landnumber"],
							"owner" => $yml ["owner"],
							"resident" => $yml ["members"],
							"isHome" => true,
							"startX" => $yml ["startx"],
							"endX" => $yml ["endx"],
							"startZ" => $yml ["startz"],
							"endZ" => $yml ["endz"],
							"protect" => true,
							"allowOption" => [ ],
							"forbidOption" => [ ],
							"areaPrice" => $yml ["price"],
							"welcome" => $yml ["welcomemessage"],
							"pvpAllow" => $yml ["isallowfight"],
							"invenSave" => true
					];
			$this->getLogger()->info($i."번 땅 변환 중...");
			$i = $i + 1;
			(new Config($this->getDataFolder().'protects.json', Config::JSON, $convertedData))->save();
		}
	}
}
?>