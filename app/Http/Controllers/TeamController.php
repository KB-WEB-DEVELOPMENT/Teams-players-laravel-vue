<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Team;
use App\Http\Requests;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class TeamController extends Controller  {

    public function teamsvueCrud(){

      return view('/teamsvuejscrud/index');
    }

    public function index()  {
      
        $teams = Team::latest()->paginate(6);
        $response = [
          'pagination' => [
            'total' => $teams->total(),
            'per_page' => $teams->perPage(),
            'current_page' => $teams->currentPage(),
            'last_page' => $teams->lastPage(),
            'from' => $teams->firstItem(),
            'to' => $teams->lastItem()
          ],
          'data' => $teams
        ];
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
          'name' => 'required',
        ]);
        $create = Player::create($request->all());
        return response()->json($create);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'name' => 'required',
      ]);
      $edit = Team::find($id)->update($request->all());
      return response()->json($edit);
    }
    
    public function destroy($id)
    {
        $team = Team::find($id)
		
		$team->players()->delete();
		
		$team->delete();
		
        return response()->json(['done']);
    }
}
