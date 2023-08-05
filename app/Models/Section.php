<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public static function sections() {
        $getSections = Section::with('categories')->where('status',1)->get()->toArray();
        return $getSections;
    }

    public function categories() {
        return $this->hasMany('App\Models\Category','section_id')->where(['parent_id'=>0,'status'=>1])->with('subcategories');
    }
    
    public function couponCategories() {
        return $this->hasMany('App\Models\Category','section_id')->where(['parent_id'=>0,'status'=>1])->with(['subcategories'=>function($query) {
            $query->select('id','parent_id','category_name');
        }]);
    }

    public static function sectionDetails($url) {
        $sectionDetails = Section::select('id','name','url')->with('categories')->where('url',$url)->first()->toArray();
        $sectionName = $sectionDetails['name'];
        $sectionUrl = $sectionDetails['url'];
        $sectionParent = "main";
        $filter = "section";
        $sectionIds = array();

        foreach($sectionDetails['categories'] as $key => $category) {
            $sectionIds[] = $category['id'];
            foreach($category['subcategories'] as $key => $subcategory) {
                $sectionIds[] = $subcategory['id'];
            }
        }
        $resp = array('categoryName'=>$sectionName,'sectionUrl'=>$sectionUrl,'filter'=>$filter, 'categoryParent'=>$sectionParent,'categoryIds'=>$sectionIds,'categoryDetails'=>$sectionDetails);
        return $resp;
    }
}
