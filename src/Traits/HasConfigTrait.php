<?php
namespace Michelangelo\Confy\Traits;

use Michelangelo\Confy\Models\Confy;

trait HasConfigTrait {

    /**
     * @param string $key
     * @param string $data
     * @param string $category
     * @return bool
     */
    public function putConfig(string $key, string $data, string $category = 'default'){
        $config = Confy::updateOrCreate([
            'key' => $key,
            'category' => $category,
            'model_id' => $this->id,
            'model_type' => get_class($this)
        ], [
            'data' => $data,
            'isJson' => false
        ]);
        return (bool) ($config);
    }

    /**
     * @param string $key
     * @param array $data
     * @param string $category
     * @return bool
     */
    public function putArrayConfig(string $key, array $data, string $category = 'default'){
        $config = Confy::updateOrCreate([
            'key' => $key,
            'category' => $category,
            'model_id' => $this->id,
            'model_type' => get_class($this)
        ], [
            'data' => json_encode($data, true),
            'isJson' => true
        ]);
        return (bool) ($config);
    }

    /**
     * @param string $key
     * @param string $category
     * @return mixed|null
     */
    public function getConfig(string $key, string $category = 'default'){
        $config = Confy::where('model_id', $this->id)
            ->where('model_type', get_class($this))
            ->where('key', $key)
            ->where('category', $category)->first();
        if($config !== null && $config->isJson)
            return json_decode($config->data, true);
        elseif ($config !== null && !$config->isJson){
            return $config->data;
        } else
            return null;
    }

}
