<?php

// Event fired when player join arena
// © PocketMineDevelopers 2015

namespace SurvivalGames\Event;


use pocketmine\event\Cancellable;
use pocketmine\event\plugin\PluginEvent;
use pocketmine\Player;
use SurvivalGames\Arena\Arena;

class PlayerJoinArenaEvent extends PluginEvent implements Cancellable{

    public static $handlerList = null;

    protected $player;
    protected $arena;

    protected $cancelled = false;
 
    public function __construct(Player $player, Arena $arena){
        $this->player = $player;
        $this->arena = $arena;
    }

    public function getPlayer(){
        return $this->player;
    }

    public function getArena(){
        return $this->arena;
    }
}
