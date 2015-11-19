<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use App\User;
use App\Tags;
// use Request;
// use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

include 'SearchControllerFcns.php';

class SearchController extends Controller
{
    public function searchParent(Request $request) {
        $searchBy = $request->input('searchmode');
        switch ($searchBy) {
            case 'id':
                return self::searchByDataID($request->input('searchbox'));
                break;
            case 'author':
                return self::searchByAuthor($request->input('searchbox'));
                break;
            case 'name':
                return self::searchByName($request->input('searchbox'));
                break;
            case 'tag':
                return self::searchByTag($request->input('searchbox'));
                break;
        }
    }

    public static function searchByAuthor($author) {
        $fcns = new SearchControllerFcns;
        $query = $fcns->advQuery($author);
        $search = User::where('name', 'like', $query)->get(['name'])->toArray();
        if(!empty($search)) {
            if(count($search) == 1) {
                return redirect('whatdata/author/' . $search[0]['name']);
            }
            else {
                return view('searchResultsAuthor')->with('searchResults', $search);
            }
        }
        else {
            echo "No such author found. Query: " . $query;
        }
    }

    public static function searchByDataID($id) {
        try {
            $user = Data::withTrashed()->findOrFail($id);
            return redirect('whatdata/' . $id);
        }
        catch(ModelNotFoundException $e) {
            echo "No such data found.";
        }
    }

    public static function searchByName($name) {
        $fcns = new SearchControllerFcns;
        $query = $fcns->advQuery($name);
        $search = Data::where('name', 'like', $query)->get(['id', 'name', 'idnum'])->toArray();
        if(!empty($search)) {
            if(count($search) == 1) {
                return redirect('whatdata/' . $search[0]['id']);
            }
            else {
                return view('searchResultsNames')->with('searchResults', $search);
            }
        }
        else {
            echo "No such name found. Query: " . $query;
        }
    }

    public static function searchByTag($tag) {
        $fcns = new SearchControllerFcns;
        $query = $fcns->advQuery($tag);
        $search = Tags::where('name', 'like', $query)->get(['id', 'name', 'created_at']);
        $searchCount = count($search);
        if(!empty($search)) {
            if($searchCount == 1) {
                return redirect('whatdata/tags/' . $search[0]['name']);
            }
            else {
                foreach($search as $result) {
                    $result['count'] = count($result->data);
                }
                return view('searchResultsTags', ['searchResults' => $search, 'searchCount' => $searchCount]);
            }
        }
    }
}
