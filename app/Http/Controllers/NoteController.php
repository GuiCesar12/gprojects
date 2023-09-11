<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Note;
use Illuminate\Database\QueryException;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(Request $request){

        $notes = Note::all();
        $projects = Project::all();
        return view('projects.notes',['notes'=>$notes,'projects'=>$projects,'title2' => 'Notes', 'variable' => 'Note', 'icon' => 'align-left']);

    }
    public function selectAll(Request $request){
        if(isset($request->id) || $request->id != null){
            $projectId = $request->id;
            return DB::table('notes')
            ->join('projects','projects.id','=','notes.id_project')
            ->where('id_project', '=', $projectId)
            ->select('notes.*','projects.project')
            ->get();
        }
        else{
            return ;
        }

    }
    public function create(Request $request){
        $datas = collect($request->all());
        try{
            Project::validateForm($datas);
            $notes = new Note;
            $notes->note = $request->note;
            $notes->id_project = $request->projectNote;
            return strval($notes->save());
        }catch(Exception $ex){
            return response('Empty Fields',400);
        }
        catch(QueryException $e){
            if($e->errorInfo[0]=="23000" && $e->errorInfo[1] == 1062){
                return response('Value already exists, try saving with another name', 405);
            }
            return response($e->getMessage(), 405);
        }
    }
    public function update(Request $request){
        try{
            $note = Note::find($request->idNote);
            $note->note = $request->note;
            $note->id_project = $request->projectNote; 
            return strval($note->update());

        } catch(QueryException $e){
            if($e->errorInfo[0]=="23000" && $e->errorInfo[1] == 1062){
                return response('Value already exists, try saving with another name', 405);
        }
        return response("Empty fields", 405);
        }
    }
    public function delete(Request $request){
        try{
            return strval(Note::find($request->id)->delete());

        }
        catch(QueryException $e){
            if($e->errorInfo[0]=="23000" && $e->errorInfo[1] == 1062){
                return response('Value already exists, try saving with another name', 405);
        }
        return response($e->getMessage(), 405);
        }
    }
}