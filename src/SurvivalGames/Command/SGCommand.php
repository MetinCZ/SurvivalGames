<?php

// SurvivalGames Command
// © PocketMineDevelopers 2015

namespace SurvivalGames\Command;

use pocketmine\command\CommandSender;
use pocketmine\Player;
use SurvivalGames\SurvivalGames;
use SurvivalGames\arena\Arena;

class SGCommand extends BaseCommand{

   public $data;

    public function __construct(SurvivalGames $plugin, Arena $arena){
     $this->data = 
      [
       "manager" => $plugin->messagesManager,
       "arenas" => $plugin->arenas,
       "arena" => $arena
      ];
     parent::__construct($plugin, "survivalgames", "Main sg command", "/survivalgames", "/survivalgames", ["sg"]);
    }

    public function execute(CommandSender $sender, $alias, array $args) {
     if($sender instanceof Player){
      switch($args[0]){
       case "join":
        $arenatojoin = array_rand($this->data["arenas"],1);
        if (!(isset($this->data["players"][$sender->getName()]))){
         if ($this->data["arena"]->isArenaFull()){
         $this->plugin->getServer()->getPluginManager()->callEvent(new PlayerJoinArenaEvent($sender,$arenatojoin));
         }
         else {
          $sender->sendMessage($this->data["manager"]->getMsg("game_full"));   
         }
        }
        else {
         $sender->sendMessage($this->data["manager"]->getMsg("already_ingame"));  
        }
       break;     
      }
     }
    }
}
