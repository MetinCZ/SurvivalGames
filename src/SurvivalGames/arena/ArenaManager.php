<?php
/**
 * Created by PhpStorm.
 * User: Honza
 * Date: 16. 9. 2015
 * Time: 16:50
 */

namespace SurvivalGames\Arena;


use pocketmine\Player;

class ArenaManager{

    public $plugin;

    public function __construct(Arena $plugin){
        $this->plugin = $plugin;
    }

    public function getArenaPlayers($ingame = false){

    }

    public function messageAllPlayers($message){

    }

    public function inArena(Player $p){
        return isset($this->plugin->players[strtolower($p->getName())]) ? true : false;
    }

    public function isArenaFull(){

    }

    public function checkAlive(){

    }

    public function refillChests(){

    }
}