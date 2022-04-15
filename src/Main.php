<?php

namespace xqwtxon\SlapperParticleV2;

use pocketmine\plugin\PluginBase;
use xqwtxon\SlapperParticleV2\ParticleEffect;
use xqwtxon\SlapperParticleV2\SlapperParticleInfo;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use pocketmine\VersionInfo;

class Main extends PluginBase{
    public function onLoad() :void{
        $this->saveResource("config.yml");
        $log = $this->getServer()->getLogger();
        $config = $this->getConfig();
        if ($config->get("config-version") == SlapperParticlesInfo::CONFIG_VERSION){
            @rename($this->getDataFolder()."/"."config.yml", $this->getDataFolder()."/"."old-config.yml");
            $log->notice("[NOTICE] Your configuration is outdated! The configuration was renamed as old-config.yml");
            $this->saveResource("config.yml");
        } else {
            $this->saveDefaultConfig();
            $log->info("[INFO] The plugin was loaded!");
        }
        if (SlapInfo::IS_DEVELOPMENT_BUILD == true){
            $log->warning(TextFormat::RED."Your SlapperParticle is in development build! You may expect crash during the plugin. You can make issue about this plugin by visiting plugin github issue!");
            return;
        }
    }
    public function onEnable(): void{
        $config = $this->getConfig();
        $log = $this->getServer()->getLogger();
            if (SlapperParticlesInfo::PROTOCOL_VERSION == ProtocolInfo::CURRENT_PROTOCOL){
                $log->info(TextFormat::GREEN."[INFO] Your SlapperParticles is Compatible with your version!");
            } else {
                $log->info(TextFormat::RED."[ERROR] Your SlapperParticles isnt Compatible with your version!");
                $this->getServer()->getPluginManager()->disablePlugin($this);
            }
        if (isset($colorA)) {
            $log->error("[ERROR] Color A is blank!");
            $log->notice("[NOTICE] Color A modified to 255 as default.")
            $this->getConfig()->set("Color A", 255);
            return;
        }
        if (isset($colorB)) {
            $log->error("[ERROR] Color B is blank!");
            $log->notice("[NOTICE] Color B modified to 255 as default.")
            $this->getConfig()->set("Color B", 255);
            return;
        }
        if (isset($colorC)) {
            $log->error("[ERROR] Color C is blank!");
            $log->notice("[NOTICE] Color C modified to 255 as default.")
            $this->getConfig()->set("Color C", 255);
            return;
        }
        
        if ($toggle == true){
            $this->getServer()->getPluginManager()->registerEvents(new SlapperParticleListener($this), 2);
            return;
            }
            
            if ($toggle == false){
                $log->warning("[INFO] The SlapperRotation is disabled by configuration.");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            }
		$this->saveDefaultConfig(); 
    }
    
    public function onDisable() :void{
        $config = $this->getConfig();
        $log = $this->getServer()->getLogger();
        $log->info(TextFormat::RED."Successfully disabled the plugin!");
    }
}
