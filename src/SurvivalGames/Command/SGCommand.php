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
   public $plugin;
   public $arena;

    public function __construct(SurvivalGames $plugin, Arena $arena){
     $this->plugin = $plugin;
     $this->arena= $arena;
     $this->data = 
      [
       "msg" => $plugin->msg->getAll();
       "arena" => $plugin->arenas;
       "players" => $arena->players;
      ];
     parent::__construct($plugin, "survivalgames", "Main sg command", "/survivalgames", "/survivalgames", ["sg"]);
    }

    public function execute(CommandSender $sender, $alias, array $args) {
     if($sender instanceof Player){
      switch($args[0]){
       case "join":
        
       break;     
      }
     }
    }
}
