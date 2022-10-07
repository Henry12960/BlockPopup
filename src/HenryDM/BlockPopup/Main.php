<?php

namespace HenryDM\BlockPopup;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;

class Main extends PluginBase implements Listener {

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this); 
        $this->saveResource("config.yml");
    }

    public function onBreak(BlockBreakEvent $event) {

# ====================================================================        
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $block = $event->getBlock()->getName();
        $messageB = str_replace(["{block}", "{line}"], [$block, "\n"], $this->getConfig()->get("break-popup-message"));
# ====================================================================

        if($this->getConfig()->get("break-popup") === true) {
            if(in_array($worldName, $this->getConfig()->get("block-popup-worlds", []))) {
               $player->sendPopup($messageB);
            }
        }
    }

    public function onPlace(BlockPlaceEvent $event) {

# ====================================================================        
        $player = $event->getPlayer();
        $world = $player->getWorld();
        $worldName = $world->getFolderName();
        $block = $event->getBlock()->getName();
        $messageP = str_replace(["{block}", "{line}"], [$block, "\n"], $this->getConfig()->get("place-popup-message"));
# ====================================================================
        if($this->getConfig()->get("place-popup") === true) {
            if(in_array($worldName, $this->getConfig()->get("block-popup-worlds", []))) {
               $player->sendPopup($messageP);
            }
        }
    }
}