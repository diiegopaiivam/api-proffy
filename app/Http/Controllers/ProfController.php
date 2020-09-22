<?php


namespace App\Http\Controllers;
use App\Models\Classe as Aula;
use App\Models\ClassSchedule;
use App\Models\Connection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Utils\Helpers;
use Illuminate\Support\Facades\DB;


class ProfController extends Controller
{

    public function index(Request $request, Response $response)
    {
        if(!$request->query()){
            return response()->json("Missing to Search Classes!", 400);
        }

        $hour = Helpers::convertHourToMinute($request->query()['time']);

        $classes = DB::table('classes')
            ->join('users', 'users.id', '=', 'classes.user_id')
            ->join('class_schedule', 'class_schedule.class_id', '=', 'classes.id')
            ->where('subject', $request->query()['subject'])
            ->where('week_day', $request->query()['week_day'])
            ->where('from', '<=', $hour)
            ->where('to', '>', $hour)
            ->get();

        
        if(count($classes) === 0 || count($classes) === ""){
            return response()->json([
                'status'    => 0,
                'message'   => 'Não ha professores disponiveis para esse horário',
                'result'    => ''
            ], 200);
        }

        return response()->json([
            'status' => 1,
            'message' => 'Sucesso',
            'result' => $classes
        ], 200);
    }

    public function store(Request $request, Response $response)
    {

       $proffy = User::create([
           'name'           => $request->name,
           'whatsapp'       => $request->whatsapp,
           'avatar'         => $request->avatar,
           'bio'            => $request->bio,
           'avaliable'      => '10'
       ]);


       $aula = Aula::create([
           'subject'         => $request->subject,
           'cost'            => $request->cost,
           'user_id'         => $proffy->id
       ]);

       foreach ($request->schedule as $marked){
           $schedulle = ClassSchedule::create([
              'week_day'    => $marked['week_day'],
               'from'       => Helpers::convertHourToMinute($marked['from']),
               'to'         => Helpers::convertHourToMinute($marked['to']),
               'class_id'   => $aula->id,
           ]);
       }


        return response()->json("Professor Cadastrado", 201);

    }

    public function connection(Request $request, Response $response)
    {
        $connection = Connection::create([
            'user_id' => $request->user_id
        ]);

        return response()->json('Conexão criada', 201);
    }

    public function getConnections(Request $request, Response $response)
    {
        $total = DB::table('connections')->count('*' );

        return response()->json($total, 200);
    }

    


}
