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
        dump(request()->all());
        switch ($request->input('tipoCilindro')) {
            case 'D':
                $constante = 0.16;
                break;
            case 'E':
                $constante = 0.26;
                break;
            case 'M':
                $constante = 1.56;
                break;
        }
        $duracion = ( ($request->input('presion') - 200 ) * $constante ) / $request->input('flujo');
        dump("Duración: " .$this->minutosAHoras($duracion) . " horas");
        //return view('index');

        $cte = 4;
        $peso = 95; // Peso del paciente en kg
        $SCTQ = 64;


        dump("Peso: " . $peso . " Kgs");

        dump("Superficie corporal total quemada: " . $SCTQ . " %");

        $volumen24 = $cte * $peso * $SCTQ;
        dump("Volumen: " . $volumen24 . " ml en 24 horas");
        $volumen8 = $volumen24 * 0.50;
        dump("Volumen: " . $volumen8 . " ml en 8 horas");
        $volumen1 = $volumen8 / 8;
        dump("Volumen: " . $volumen1 . " ml en 1 hora");
        $volumen1min = $volumen1 / 60;
        dump("Volumen: " . $volumen1min . " ml en 1 minuto");
        $volumenNormogotero = $volumen1min * 20;
        dump("Volumen: " . $volumenNormogotero . " gotas por minuto");


    }

    private function minutosAHoras($minutos)
    {
        $horas = floor($minutos / 60);
        $min = $minutos % 60;

        return sprintf('%02d:%02d', $horas, $min);
    }    

}
