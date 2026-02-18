<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return view('index');
    }

    public function calcularDuracionOxigeno(Request $request)
    {
        //dump(request()->all());
        $presion = $request->input('presion');
        $tipoCilindro = $request->input('tipoCilindro');
        $flujo = $request->input('flujo');

        $duracion = ( ($presion - 200 ) * $tipoCilindro ) / $flujo;

        $duracion = $this->minutosAHoras($duracion) . " horas";

        return view('index', compact('duracion','presion','tipoCilindro','flujo'));
    }

    private function minutosAHoras($minutos)
    {
        $horas = floor($minutos / 60);
        $min = $minutos % 60;

        return sprintf('%02d:%02d', $horas, $min);
    }
    
    public function calcularReposicionLiquidos(Request $request)
    {

        $cte = 4;
        $peso = $request->peso;
        //$SCTQ = 64;

        if ($request->sctq != null) {
            $SCTQ = $request->sctq;
        } else {
            $SCTQ = $request->cabeza + $request->torax + $request->brazos + $request->piernas + $request->manos + $request->pies + $request->genitales;
        }


        //dump("Peso: " . $peso . " Kgs");

        //dump("Superficie corporal total quemada: " . $SCTQ . " %");

        $volumen24 = $cte * $peso * $SCTQ;
        //dump("Volumen: " . $volumen24 . " ml en 24 horas");
        $volumen8 = $volumen24 * 0.50;
        //dump("Volumen: " . $volumen8 . " ml en 8 horas");
        $volumen1 = $volumen8 / 8;
        //dump("Volumen: " . $volumen1 . " ml en 1 hora");
        $volumen1min = $volumen1 / 60;
        //dump("Volumen: " . $volumen1min . " ml en 1 minuto");
        $volumenNormogotero = $volumen1min * 20;
        //dump("Volumen: " . $volumenNormogotero . " gotas por minuto");

        return view('index', compact('peso', 'SCTQ', 'volumen24','volumen8','volumen1','volumen1min','volumenNormogotero'));


    }    

}
