<?php

namespace App\Http\Controllers;

use App\Http\Controllers\InfoController;
use App\Tags;

class InfoControllerFcns{

    //parses one string of tags separated by commas into separate tags
    public function tagParse($tagArray) {
        $tagListFromText = preg_split('/,\s*/', $tagArray);
        // if($toIDs == true) {
        //     $tagIDs = Tags::whereIn('name', $tagListFromText)->lists('id')->toArray();
        //     return $tagIDs;
        // }
        // else {
        return $tagListFromText;


    }

    //takes list of individual tags, checks if exists in Tags.
    // if not exist, create new tag.
    // convert result into array of tag IDs.
    public function insertTagFromArray($tagArray) {
        $tagIDs = [];
        for($i = 0; $i < count($tagArray); $i++) {
            $searchResult = Tags::where('name', '=', $tagArray[$i])->lists('id')->toArray();
            if(empty($searchResult)) {
                $newTag = new Tags;
                $newTag->name = $tagArray[$i];
                $newTag->save();
                $newTagID = $newTag->id;
                array_push($tagIDs, $newTagID);
            }
            else {
                array_merge($tagIDs, $searchResult);
            }
        }

        return $tagIDs;
    }


}
