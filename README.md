# Confy
Add configurations to your eloquent model easily

## Requirements
- **[PHP 5.6+](https://php.net/releases/)**
- **[Laravel 5.3+](https://github.com/laravel/laravel)**

## Installation
```bash
composer require michelangelomo/confy

php artisan vendor:publish --tag=migrations

php artisan migrate
```

## Usage
```php
use Illuminate\Database\Eloquent\Model;
use Michelangelo\Confy\Traits\HasConfigTrait;
class User extends Model {

    use HasConfigTrait;
    //....
    
}

$user = User::find(1);
//                  Key              Value   Category
$user->putConfig('isPublicProfile', 'true', 'privacy'); //Save single data config

$user->putArrayConfig('array', array('key' => 'value')); //Save multiple data in array
//Leave category blank for default

$user->getConfig('isPublicProfile', 'privacy'); //Returns true
$user->getConfig('array'); //Return ['key' => 'value']
```
