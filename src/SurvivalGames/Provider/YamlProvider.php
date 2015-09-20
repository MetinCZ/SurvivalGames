<?php

namespace SurvivalGames\Provider;

use pocketmine\Player;
use SurvivalGames\SurvivalGames;

class YAMLProvider implements Provider{

    private $plugin;

    public function __construct(SurvivalGames $plugin){
        $this->plugin = $plugin;
        $this->init();
    }

    public function init(){
        $this->plugin->saveResource("stats.yml");
    }

    public function addWin(Player $p){

    }

    public function addLoss(Player $p){

    }

    public function addKill(Player $p){

    }

    public function addDeath(Player $p){

    }
}