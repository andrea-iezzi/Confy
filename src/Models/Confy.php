<?php

namespace Michelangelo\Confy\Models;

use Illuminate\Database\Eloquent\Model;

class Confy extends Model {

    protected $table = 'configs';

    protected $fillable = ['key', 'category', 'model_id', 'model_type', 'data', 'isJson'];
    
    /**
     * @param string $key
     * @param string $data
     * @param string $category
     * @return bool
     */
    public static function put(string $key, string $data, string $category = 'default'){
        $config = Confy::updateOrCreate([
            'key' => $key,
            'category' => $category,
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
    public static function putArrayConfig(string $key, array $data, string $category = 'default'){
        $config = Confy::updateOrCreate([
            'key' => $key,
            'category' => $category,
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
    public static function getConfig(string $key, string $category = 'default'){
        $config = Confy::where('key', $key)
            ->where('category', $category)->first();
        if($config !== null){
            return ($config->isJson) ? json_decode($config->data, true): $config->data;
        } else
            return null;
    }

}
