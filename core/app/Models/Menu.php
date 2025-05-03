<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable=['parent','order_value','name','position','link','status'];
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent','id');
    }
    static public function getAllMenus($position){
      $menus =  self::where('status',1)->where('position',$position)->where('parent',0)->withCount('children')->orderBy('order_value','ASC')->get();
      return $nestable = self::nestable($menus);
    }
    public static function nestable($menus) {
       foreach ($menus as $menu) {
           if (!$menu->children->isEmpty()) {
               $menu->children = self::nestable($menu->children);
            }
        }
        return $menus;
    }
}
