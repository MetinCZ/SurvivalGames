<?php
/**
 * Created by PhpStorm.
 * User: Honza
 * Date: 18. 9. 2015
 * Time: 16:48
 */

namespace SurvivalGames\Command;


use pocketmine\command\CommandSender;
use pocketmine\Player;
use SurvivalGames\SurvivalGames;

class SGCommand extends BaseCommand{

    public function __construct(SurvivalGames $plugin){
        parent::__construct($plugin, "survivalgames", "Main sg command", "/survivalgames", "/survivalgames", ["sg"]);
    }

    public function execute(CommandSender $sender, $alias, array $args) {
        if($sender instanceof Player){
            switch($args[0]){

            }
        }
    }
}