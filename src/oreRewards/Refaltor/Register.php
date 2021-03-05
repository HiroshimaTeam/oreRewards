<?php
namespace oreRewards\Refaltor;
use oreRewards\Refaltor\Commands\reward;
use oreRewards\Refaltor\Events\BreakEvents;
use pocketmine\plugin\PluginBase;

class Register extends PluginBase {
    /**
     * @var Register
     */
    private static $instance;
    public function onEnable()
    {
        $this->saveDefaultConfig();
        self::$instance = $this;
        if (!self::getServer()->getPluginManager()->getPlugin("EconomyAPI")) {
            self::getServer()->getLogger()->critical("§4EconomyAPI not installed");
            self::getServer()->getPluginManager()->disablePlugins();
        } elseif (!self::getServer()->getPluginManager()->getPlugin("FormAPI")) {
            self::getServer()->getLogger()->critical("§4FormAPI not installed");
            self::getServer()->getPluginManager()->disablePlugins();;
        }
        self::getServer()->getCommandMap()->register("reward", new reward($this));
        self::getServer()->getPluginManager()->registerEvents(new BreakEvents($this), $this);
    }
    public static function getInstance() {
        return self::$instance;
    }
}