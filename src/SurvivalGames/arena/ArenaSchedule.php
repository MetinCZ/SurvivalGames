<?php

namespace SurvivalGames\arena;

//Scheduled game resetting
//© 2015 PocketMineDevelopers

use pocketmine\scheduler\Task;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class ArenaSchedule extends Task{

    public $plugin;
    public $arena;

    public function __construct(Arena $plugin){
        $this->plugin = $plugin;
    }

    public function onRun($currentTick){

    }

    private function starting(){

    }

    private function game(){

    }
}
