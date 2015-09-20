<?php

// Messages manager for SurvivalGames
// © PocketMineDevelopers 2015

namespace SurvivalGames\Arena;


use pocketmine\utils\Config;
use SurvivalGames\SurvivalGames;

class Messages{

    public $plugin;
    private $cfg;

    public function __construct(SurvivalGames $plugin){
        $this->plugin = $plugin;
        $this->cfg = $this->plugin->msg;
    }

    public function getMsg($msg){
        return str_replace("&", "§", $this->cfg[$msg]);
    }
}
