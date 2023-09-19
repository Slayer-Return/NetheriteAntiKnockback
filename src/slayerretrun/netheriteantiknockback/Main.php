<?php

/**
 *   _____ _                       _____      _                    
 *  / ____| |                     |  __ \    | |                   
 * | (___ | | __ _ _   _  ___ _ __| |__) |___| |_ _ __ _   _ _ __  
 *  \___ \| |/ _` | | | |/ _ \ '__|  _  // _ \ __| '__| | | | '_ \ 
 *  ____) | | (_| | |_| |  __/ |  | | \ \  __/ |_| |  | |_| | | | |
 * |_____/|_|\__,_|\__, |\___|_|  |_|  \_\___|\__|_|   \__,_|_| |_|
 *                  __/ |                                          
 *                 |___/                                           
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * @author SlayerRetrun Team
 * @link https://github.com/Slayer-Return
 * 
 * 
 */

declare(strict_types=1);

namespace slayerretrun\netheriteantiknockback;

use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\item\ItemTypeIds;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{
    protected function onEnable() : void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onKnockBack(EntityDamageByEntityEvent $event) : void
    {
        $victim = $event->getEntity();
        if ($victim instanceof Player){
            if ($this->isPlayerUseNetheriteArmor($victim)){
                $victim->setKnockBack(0.0);
                $victim->setVerticalKnockBackLimit(0.0);
            }
        }
    }

    public function isPlayerUseNetheriteArmor(Player $player) : bool
    {
        $playerArmorInventory = $player->getArmorInventory();
        if ($playerArmorInventory->getHelmet()->getTypeId() === ItemTypeIds::NETHERITE_HELMET &&
            $playerArmorInventory->getChestplate()->getTypeId() === ItemTypeIds::NETHERITE_CHESTPLATE &&
            $playerArmorInventory->getLeggings()->getTypeId() === ItemTypeIds::NETHERITE_LEGGINGS &&
            $playerArmorInventory->getBoots()->getTypeId() === ItemTypeIds::NETHERITE_BOOTS){
            return true;
        }
        return false;
    }
}