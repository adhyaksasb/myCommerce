<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function section() {
        return $this->belongsTo('App\Models\Section', 'section_id')->select('id','name','url');
    }

    public function parentCategory() {
        return $this->belongsTo('App\Models\Category', 'parent_id')->select('id','category_name','url');
    }

    public function subCategories() {
        return $this->hasMany('App\Models\Category', 'parent_id')->where('status', 1);
    }

    public static function categoryDetails($url) {
        $categoryDetails = Category::select('id','category_name','url','parent_id','section_id')->with('subcategories','section','parentCategory')->where('url',$url)->first()->toArray();
        $categoryName = $categoryDetails['category_name'];
        $sectionUrl = $categoryDetails['section']['url'];
        $categoryParent = $categoryDetails['parent_id'];
        $filter = "category";
        $categoryIds = array();
        $categoryIds[] = $categoryDetails['id'];

        foreach($categoryDetails['subcategories'] as $key => $subcategory) {
            $categoryIds[] = $subcategory['id'];
        }
        $resp = array('categoryName'=>$categoryName,'sectionUrl'=>$sectionUrl,'filter'=>$filter,'categoryParent'=>$categoryParent,'categoryIds'=>$categoryIds,'categoryDetails'=>$categoryDetails);
        return $resp;
    }

    public static function getCategoryName($category_id) {
        $getCategoryName = Category::select('category_name')->where('id', $category_id)->first();
        return $getCategoryName->category_name;
    }
}
