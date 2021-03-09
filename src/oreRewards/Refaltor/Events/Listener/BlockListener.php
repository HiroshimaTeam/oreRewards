<?php
namespace oreRewards\Refaltor\Events\Listener;

use oreRewards\Refaltor\Register;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class BlockListener implements Listener {

    /**
     * @param BlockBreakEvent $event
     */
    public function onBreak(BlockBreakEvent $event) {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $config = new Config(Register::getInstance()->getDataFolder() . $player->getName() . ".yml", Config::YAML);
        $cfg = Register::getInstance()->getConfig();

        if(isset($cfg->get("Rewards")[$block->getId() . ":" . $block->getDamage()])) {
            $config->set("rewards", $config->get("rewards") + $cfg->get("Rewards")[$block->getId() . ":" . $block->getDamage()]);
            $config->save();
        }
    }
}