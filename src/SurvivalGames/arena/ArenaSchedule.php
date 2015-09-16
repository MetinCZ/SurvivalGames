<?php

namespace SurvivalGames\arena;

//Scheduled game resetting
//© 2015 PocketMineDevelopers

use pocketmine\scheduler\Task;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class ArenaSchedule extends Task{

    public $refill;
    public $arena;

    public function __construct(ChestRefill $refill){
        $this->refill = $refill;
        parent::__construct($refill);
    }

    public function onRun($currentTick){

    }
}
