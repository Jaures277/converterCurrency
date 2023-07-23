<?php

namespace App\Http\Controllers;

use App\Models\Pair;
use Illuminate\Http\Request;

class PairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //return 'plop';
        $pair = Pair::latest()->with('currencyFrom','currencyTo')->get();
        return response()->json([
            'status' => true,
            'currencies'=> $pair,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $pairs = new Pair();
        $pairs->currency_id_from = $request->currency_id_from;
        $pairs->currency_id_to = $request->currency_id_to;
        $pairs->rate = $request->rate;

        $pairs->save();

        //renvoie de reponse personnalisée
        return response()->json([
            "status"=> 1,
            "message" => "paire crée avec succes"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $pair = Pair::where("id",$id)->exists();
        if($pair){

            $info = Pair::find($id);
            return response()->json([
                "status" => 1,
                "message" => "étudiant trouvée",
                "data" => $info
            ],200);
        }else{
            return response()->json([
                "status" => 0,
                "message" => "Aucune donnée trouvée",
                "data" => $pair
            ],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        $pairs = Pair::where("id",$id)->exists();
        if($pairs){

            $info = Pair::find($id);
            $info->currency_id_from = strtoupper($request->currency_id_from);
            $info->currency_id_to = strtoupper($request->currency_id_to);
            $info->rate = $request->rate;

            $info->save();
            return response()->json([
                "status" => 1,
                "message" => "Mise à jour réussi",
                "data" => $info
            ]);
        }else{
            return response()->json([
                "status" => 0,
                "message" => "paire introuvable"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $pair = Pair::where("id",$id)->exists();
        if($pair) {
            $pair = Pair::find($id);

            $pair->delete();

            return response()->json([
                "status" => 1,
                "message" => "Suppression réussie"
            ]);
        }else{
            return response()->json([
                "status" => 0,
                "message" => "pair introuvable"
            ]);
        }
    }


    public function convert($value, $currency_from, $currency_to){

        $info = Pair::where('currency_id_from',$currency_from)->where('currency_id_to',$currency_to)->first();

        if(!isset($info) || $info == Null){
            return response()->json([
                "status" => 0,
                "message" => "pair introuvable"
            ]);
        }

        $resultPaireInitial = $value * $info->rate;
        $resultPaireFinal = $value * (1/$info->rate);
        $info->exchange_number++;

        $info->save();

        return response()->json([
            "status" => 1,
            "message" => "réussie",
            "resultat1" => $resultPaireInitial,
            "resultat2" => $resultPaireFinal,
            "data" => $info
        ]);
    }

}
