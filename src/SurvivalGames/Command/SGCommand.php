<?php

// SurvivalGames Command
// © PocketMineDevelopers 2015

namespace SurvivalGames\Command;

use pocketmine\command\CommandSender;
use pocketmine\Player;
use SurvivalGames\SurvivalGames;
use SurvivalGames\arena\Arena;

class SGCommand extends BaseCommand{

   public $plugin;

   public function __construct(SurvivalGames $plugin){
      $this->plugin = $plugin;
      parent::__construct($plugin, "survivalgames", "Main sg command", "/survivalgames", "/survivalgames", ["sg"]);
    }

   public function execute(CommandSender $sender, $alias, array $args) {
      if($sender instanceof Player){
         switch(strtolower($args[0])){
            case "join":
               if(!isset($args[1]) || isset($args[2])){
                  $sender->sendMessage(TextFormat::YELLOW."use /sg join [arena]");
                  break;
               }
               if($this->plugin->getPlayerArena($sender)){
                  $sender->sendMessage($this->plugin->messagesManager()->getMsg("already_in_game"));
                  break;
               }
               if(!($arena = $this->plugin->getArena($args[1]))){
                  $sender->sendMessage("game_doesnt_exist");
                  break;
               }
               $arena->joinToArena($sender);
               break;
         }
      }
   }
}
