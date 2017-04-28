<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Player;
use App\Team;
use App\Http\Requests;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class PlayerController extends Controller
{
    public function playersvueCrud(){
      return view('/playersvuejscrud/index');
    }

    public function index()
    {
        $players = Player::latest()->paginate(6);
        $response = [
          'pagination' => [
            'total' => $players->total(),
            'per_page' => $players->perPage(),
            'current_page' => $players->currentPage(),
            'last_page' => $players->lastPage(),
            'from' => $players->firstItem(),
            'to' => $players->lastItem()
          ],
          'data' => $players
        ];
    
    
    $teams = App\Team::all();
    $response2 = [ 'data' => $teams ];
    
    return response()->json($response2);
    
    return response()->json($response);
      
  }

    public function store(Request $request)
    {
        $this->validate($request,[
          'first_name' => 'required',
          'last_name' => 'required',
          'team_id' => 'required',
        ]);
        $create = Player::create($request->all());
        return response()->json($create);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'first_name' => 'required',
        'last_name' => 'required',
    'team_id' => 'required',
      ]);
      $edit = Player::find($id)->update($request->all());
      return response()->json($edit);
    }
    
    public function destroy($id)
    {
        Player::find($id)->delete();
        return response()->json(['done']);
    }
}
