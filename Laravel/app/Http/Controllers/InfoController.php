<?php

namespace App\Http\Controllers;

use Request;
use Gate;
//use Log;
//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Data;
use App\Tags;
use App\User;
use Illuminate\Http\RedirectResponse;
use Validator;

include 'InfoControllerFcns.php' ;

class InfoController extends Controller
{
    public function __construct() {
        //require a login on all functions in this controller except for whatdata
        $this->middleware('auth', ['except' => 'whatdata']);
    }
    public function store() {
        $tags = Tags::lists('name', 'id')->toArray();
        $dataTags = null;
        return view('store', ['tags' => $tags, 'dataTags' => $dataTags]);
    }
    public function postinfo() {
        $input = Request::all();
        $user_id = Auth::id(); //confirm signed in
        $input['user_id'] = $user_id; //add author

        if(!empty($input['inputtags'])) {
            $fcns = new InfoControllerFcns;
            $tagsParsed = $fcns->tagParse($input['inputtags']);
            $tagIDs = $fcns->insertTagFromArray($tagsParsed);
        }

        //check if anything was selected in the multiselect box
        if(!empty($input['tags'])) {
            $tagListFromMulti = $input['tags'];
            if(isset($tagIDs)) {
                $tagIDs = array_merge($tagIDs, $tagListFromMulti);
            }
            else {
                $tagIDs = $tagListFromMulti;
            };
        };

        //error messages. ignore these
        $messages = [
                    'name.required' => 'The name must be required and must be written without numbers under 255 characters.',
                    'idnum' => 'Not a valid ID number.',
                    'jobtitle' => 'Please include your job title.'
                ];

        //validate
        $validator = Validator::make($input, [
            'name' => 'required|alpha|max:255',
            'idnum' => 'required|integer',
            'jobtitle' => 'required'
        ], $messages
        );
        if($validator->fails()) {
            $errors=$validator->messages();
            return redirect()->back()->with('errors', $errors);
        }

        //create entry in Data
        $entry = Data::create($input);

        //get tag ID and insert into pivot table

        $entry->tags()->attach($tagIDs);

        //redirect to appropriate data view by data ID
        $id = $entry->id;

        return redirect('whatdata/' . $id);
    }
    public function editinfo($id, $errors=null) {
        $data = Data::findOrFail($id);
        $user = Auth::user();
        if($user->cannot('change', $data)) {
            return back()->with('errors', ['You are not authorized to do this.']);
        }
        $allTags = Tags::lists('name', 'id')->toArray();
        $dataTags = $data->tags->lists('id')->toArray();
        // dd($dataTags);
        if($errors) {
            return view('store', ['data' => $data, 'id' => $id, 'errors' => $errors, 'tags' => $allTags, 'dataTags' => $dataTags]);
        }
        else {
            return view('store', ['data' => $data, 'id' => $id, 'tags' => $allTags, 'dataTags' => $dataTags]);
        }
    }
    public function updateinfo($id) {
        $input = Request::all();
        $entry = Data::findOrFail($id);
        $validator = Validator::make($input, [
            'name' => 'required|alpha|max:255',
            'idnum' => 'required|integer',
            'jobtitle' => 'required']);
        if($validator->fails()) {
            $errors=$validator->messages();
            return redirect()->back()->with('errors', $errors);
        }
        $entry->update($input);

        //tags functionality from text box
        if(!empty($input['inputtags'])) {
            $fcns = new InfoControllerFcns;
            $tagsParsed = $fcns->tagParse($input['inputtags']);
            $tagIDs = $fcns->insertTagFromArray($tagsParsed);
        }

        // tags functionality from select box
        if(!empty($input['tags'])) {
            $tagListFromMulti = $input['tags'];
            if(isset($tagIDs)) {
                $tagIDs = array_merge($tagIDs, $tagListFromMulti);
            }
            else {
                $tagIDs = $tagListFromMulti;
            };
        };
        $entry->tags()->sync($tagIDs);
        $data = Data::all();
        return redirect('whatdata/' . $id)->with('data', $data);
    }
    public function deleteConfirmation($id) {
        $delete = true;
        return self::whatdata($id, $delete);
    }
    public function deleteinfo($id) {
        $data = Data::find($id);
        $user = Auth::user();
        if($user->cannot('change', $data)) {
            return back()->with('errors', ['You are not authorized to do this.']);
        }
        else {
            $data->delete();
            return redirect('whatdata');
        }
    }
    public function restoreinfo($id) {
        $data = Data::onlyTrashed()->find($id);
        $data->restore();
        $success = 'Restoration successful.';
        return self::whatdata($id, $delete=false, $success);
    }
    public function whatdata($id=null, $delete=false, $success=null) {
        if($id) {
            $data = Data::withTrashed()->find($id);
            if(isset($data->deleted_at)) {
                return view('deleteddata', ['deletedAt' => $data->deleted_at->format('Y-M-d H:i'), 'id' => $id]);
            }
            $tags = $data->tags->lists('name')->toArray();
            // $author = User::find($data->user_id)->lists('name')->toArray();
            $author = User::where('id', '=', $data->user_id)->get(['name']);
            // return $tags;
            return view('whatdata_id', ['data' => $data, 'tags' => $tags, 'author' => $author[0]['name'], 'delete' => $delete, 'success' => $success]);
        }
        else {
            $data = Data::all();
            return view('whatdata')->with('data', $data);
        }
    }
    public function whatdata_author($name) {
        $user = User::where('name', '=', $name)->first();
        $posts = $user->entries;
        // dd($posts);
        return view('whatdata', ['author' => $name, 'data' => $posts]);
    }
    public function whatdata_tags($name) {
        $tag = Tags::where('name', '=', $name)->first();
        $posts = $tag->data;
        return view('whatdata', ['tag' => $name, 'data' => $posts]);
    }
}
