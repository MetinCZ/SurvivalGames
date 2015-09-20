<?php

namespace SurvivalGames;

//© 2015 PocketMineDevelopers Team

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use SurvivalGames\Arena\Arena;

class SurvivalGames extends PluginBase{

    public $arenas = [];
    public $messagesManager;
    public $cfg;
    public $msg;

    public function onLoad(){
        $this->initConfig();
        $this->getLogger()->info(TextFormat::YELLOW.$this->msg->get("plugin-load"));
    }

    public function onEnable(){
        $this->cfg = (new Config($this->getDataFolder()."config.yml", Config::YAML))->getAll();
        $this->messagesManager = new Messages($this);
        $this->loadArenas();
        $this->getLogger()->info(TextFormat::DARK_GREEN.$this->msg->get("plugin-enable"));
    }

    public function onDisable(){
     $this->getLogger()->info(TextFormat::DARK_RED.$this->msg->get("plugin-disable"));
    }

    private function registerArena($arena, $data){
        $this->arenas[$arena] = new Arena($this, $arena, $data);
    }

    private function loadArenas(){
        $this->getLogger()->info("checking arena files...");
        foreach(glob($this->getDataFolder()."arenas/*.yml") as $file){
            $cfg = new Config($file, Config::YAML);
            $fname = basename($file, ".yml");
            if(!$this->checkSettings($cfg)){
                $this->getLogger()->error("Arena \"$fname\" is not set properly");
                continue;
            }
            $this->registerArena($cfg->get("name"), $cfg->getAll());
            $this->getLogger()->info("$fname - ".TextFormat::GREEN."checking sucessful");
        }
    }

    private function checkSettings(Config $cfg){
        $data = $cfg->getAll();
        if(!(isset($data["name"]) && isset($data["world"]) && isset($data["area_pos1"]) && isset($data["area_pos2"]) && isset($data["sign"]) && isset($data["leave_position"]) && isset($data["spawn_positions"]) && isset($data["time"]))){
            return false;
        }
        foreach($data as $key => $index){
            switch($key){
                case "world":
                    if(!$this->getServer()->isLevelGenerated($index)){
                        $this->getServer()->generateLevel($index);
                    }
                    break;
                case "area_pos1":
                    if(!(isset($index["x"]) && isset($index["y"]) && isset($index["z"]))){
                        return false;
                    }
                    foreach($index as $key1 => $index1){
                        switch($key){
                            case "x":
                                if(!is_numeric($index1)){
                                    return false;
                                }
                                break;
                            case "y":
                                if(!is_numeric($index1)){
                                    return false;
                                }
                                break;
                            case "z":
                                if(!is_numeric($index1)){
                                    return false;
                                }
                                break;
                        }
                    }
                    break;
                case "are_pos2":
                    if(!(isset($index["x"]) && isset($index["y"]) && isset($index["z"]))){
                        return false;
                    }
                    foreach($index as $key1 => $index1){
                        switch($key){
                            case "x":
                                if(!is_numeric($index1)){
                                    return false;
                                }
                                break;
                            case "y":
                                if(!is_numeric($index1)){
                                    return false;
                                }
                                break;
                            case "z":
                                if(!is_numeric($index1)){
                                    return false;
                                }
                                break;
                        }
                    }
                    break;
                case "sign":
                    if(!(isset($index["join_sign"]) && isset($index["allow_status"]) && isset($index["status_line_1"]) && isset($index["status_line_2"]) && isset($index["status_line_3"]) && isset($index["status_line_4"]))){
                        return false;
                    }
                    foreach($index as $key1 => $index1){
                        switch($key1){
                            case "join_sign":
                                if(!(isset($index["x"]) && isset($index["y"]) && isset($index["z"]))){
                                    return false;
                                }
                                foreach($index1 as $key2 => $index2){
                                    switch($key2){
                                        case "x":
                                            if(!is_numeric($index2)){
                                                return false;
                                            }
                                            break;
                                        case "y":
                                            if(!is_numeric($index2)){
                                                return false;
                                            }
                                            break;
                                        case "z":
                                            if(!is_numeric($index2)){
                                                return false;
                                            }
                                            break;
                                    }
                                }
                                break;
                            case "allow_status":
                                if($index1 != "true" && $index1 != "false"){
                                    return false;
                                }
                                break;
                        }
                    }
                    break;
                case "leave_position":
                    if(!(isset($index["x"]) && isset($index["y"]) && isset($index["z"]))){
                        return false;
                    }
                    foreach($index as $key1 => $index1){
                        switch($key1){
                            case "x":
                                if(!is_numeric($index2)){
                                    return false;
                                }
                                break;
                            case "y":
                                if(!is_numeric($index2)){
                                    return false;
                                }
                                break;
                            case "z":
                                if(!is_numeric($index2)){
                                    return false;
                                }
                                break;
                        }
                    }
                    break;
                case "spawn_positions":
                    foreach($index as $key1 => $index1){
                        if(!is_array($index1)){
                            continue;
                        }
                        foreach($index1 as $index2){
                            if(!is_numeric($index2)){
                                return false;
                            }
                        }
                    }
                    break;
                case "time":
                    if($index != "cycle" && $index != "night" && $index != "day" && !is_numeric($index)){
                        return false;
                    }
                    break;
            }
        }
        return true;
    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){

    }

    public function getPlayerArena(Player $p){
        $result = false;
        foreach($this->arenas as $arena){
            if($arena->inArena($p)){
                $result = true;
                break;
            }
        }
        return $result;
    }

    public function getArena($arena){
        return isset($this->arenas[$arena]) ? $this->arenas[$arena] : false;
    }

    public function initConfig(){
        if(!file_exists($this->getDataFolder())){
            @mkdir($this->getDataFolder());
        }
        $this->saveResource("config.yml");
        $this->cfg = new Config($this->getDataFolder()."config.yml", Config::YAML);
        if(!file_exists($this->getDataFolder()."arenas/")){
            @mkdir($this->getDataFolder()."arenas/");
            $this->saveResource("arenas/default.yml");
        }
        if(!file_exists($this->getDataFolder()."languages/")){
            @mkdir($this->getDataFolder()."languages/");
        }
        $this->saveResource("languages/English.yml");
        $this->saveResource("languages/Czech.yml");
        if(!file_exists($this->getDataFolder()."languages/{$this->cfg->get('language')}.yml")){
            $this->msg = new Config($this->getDataFolder()."languages/English.yml", Config::YAML);
            $this->getServer()->getLogger()->info("Selected language English");
            return;
        }
        $this->msg = new Config($this->getDataFolder()."languages/{$this->cfg->get('Language')}.yml", Config::YAML);
        $this->getServer()->getLogger()->info("Selected language {$this->cfg->get('Language')}");
    }
}
