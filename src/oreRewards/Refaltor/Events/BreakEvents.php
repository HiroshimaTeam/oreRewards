<?php
namespace oreRewards\Refaltor\Events;
use oreRewards\Refaltor\Register;
use pocketmine\block\Block;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class BreakEvents implements Listener {

    /**
     * @var Register
     */

    private $plugin;
    public function __construct(Register $plugin) {
        $this->plugin = $plugin;
    }
    public function onBreak(BlockBreakEvent $event) {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        $config = new Config($this->plugin->getDataFolder() . $player->getName() . ".yml", Config::YAML);
        $cfg = Register::getInstance()->getConfig();

        if ($block->getId() === Block::COAL_ORE) {
            $config->set("rewards", $config->get("rewards") + $cfg->get("Coal"));
            $config->save();
        }

        if ($block->getId() === Block::IRON_ORE) {
            $config->set("rewards", $config->get("rewards") + $cfg->get("Iron_ore"));
            $config->save();
        }

        if ($block->getId() === Block::GOLD_ORE) {
            $config->set("rewards", $config->get("rewards") + $cfg->get("Gold_ore"));
            $config->save();
        }

        if ($block->getId() === Block::DIAMOND_ORE) {
            $config->set("rewards", $config->get("rewards") + $cfg->get("Diamond_ore"));
            $config->save();
        }

        if ($block->getId() === Block::LAPIS_ORE) {
            $config->set("rewards", $config->get("rewards") + $cfg->get("Lapis_ore"));
            $config->save();
        }

        if ($block->getId() === Block::EMERALD_ORE) {
            $config->set("rewards", $config->get("rewards") + $cfg->get("Emerald_ore"));
            $config->save();
        }

        if ($block->getId() === Block::STONE) {
            $config->set("rewards", $config->get("rewards") + $cfg->get("Stone"));
            $config->save();
        }
    }
}