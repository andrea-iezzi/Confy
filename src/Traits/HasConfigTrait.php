<?php
namespace Michelangelo\Confy\Traits;

use Michelangelo\Confy\Models\Config;

trait HasConfigTrait {

    /**
     * @param string $key
     * @param string $category
     * @param string $data
     * @return bool
     */
    public function putConfig(string $key, string $category = 'default', string $data){
        $config = Config::firstOrCreate(['key' => $key, 'category' => $category, 'model_type' => get_class($this), 'model_id' => $this->id]);
        $config->data = $data;
        $config->isJson = false;
        $config->save();

        return (bool) ($config);
    }

    /**
     * @param string $key
     * @param string $category
     * @param array $data
     * @return bool
     */
    public function putArrayConfig(string $key, string $category = 'default', array $data){
        $config = Config::firstOrCreate(['key' => $key, 'category' => $category, 'model_type' => get_class($this), 'model_id' => $this->id]);
        $config->data = json_encode($data);
        $config->isJson = true;
        $config->save();

        return (bool) ($config);
    }

    /**
     * @param string $key
     * @param string $category
     * @return mixed|null
     */
    public function getConfig(string $key, string $category = 'default'){
        $config = Config::where('model_id', $this->id)
            ->where('model_type', get_class($this))
            ->where('key', $key)
            ->where('category', $category)->first();
        if($config !== null && $config->isJson)
            return json_decode($config->data);
        elseif ($config !== null && !$config->isJson){
            return $config->data;
        } else
            return null;
    }

}
