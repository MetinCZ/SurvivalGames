<?php

namespace SurvivalGames;

//© 2015 PocketMineDevelopers Team

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class SurvivalGames extends PluginBase{

    public $arenas = [];

    public function onEnable(){

    }

    public function onDisable(){

    }

    private function registerArena($arena){

    }

    private function loadArenas(){
        foreach(glob($this->getDataFolder()."arenas/") as $file){

        }
    }

    private function checkSettings(Config $cfg){

    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){

    }

    public function getPlayerArena(Player $p){

    }

    public function getArena($arena){

    }
}
