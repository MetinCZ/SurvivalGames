<?php

// Event fired when player join arena
// © PocketMineDevelopers 2015

namespace SurvivalGames\Event;


use pocketmine\event\plugin\PluginEvent;

class PlayerJoinArenaEvent extends PluginEvent{
 
 public $player;
 public $arena;
 
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
