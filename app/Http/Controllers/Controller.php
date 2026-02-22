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

        switch ($tipoCilindro) {
            case '0.16':
                $letraTipoCilindro = 'D';
                break;
            case '0.28':
                $letraTipoCilindro = 'Jumbo D';
                break;
            case '0.26':
                $letraTipoCilindro = 'E';
                break;
            case '2.41':
                $letraTipoCilindro = 'G';
                break;                              
            case '3.14':
                $letraTipoCilindro = 'H/K';
                break;
            case '1.56':
                $letraTipoCilindro = 'M';
                break;
            default:
                $letraTipoCilindro = 'Desconocido'; // Valor por defecto en caso de entrada no válida
        }

        switch ($flujo) {
            case '1':
                $dispositivoFlujo = '1 L/min - Puntas nasales - 21-24% oxígeno';
                break;
            case '2':
                $dispositivoFlujo = '2 L/min - Puntas nasales - 25-28% oxígeno';
                break;
            case '3':
                $dispositivoFlujo = '3 L/min - Puntas nasales - 29-32% oxígeno';
                break;
            case '4':
                $dispositivoFlujo = '4 L/min - Puntas nasales - 23-36% oxígeno';
                break;
            case '5':
                $dispositivoFlujo = '5 L/min - Puntas nasales - 37-40% oxígeno';
                break;
            case '6':
                $dispositivoFlujo = '6 L/min - Puntas nasales - 41-44% oxígeno';
                break;
            case '10':
                $dispositivoFlujo = '6-10 L/min - Mascarilla facial de oxígeno simple - 60% oxígeno';
                break;
            case '15':
                $dispositivoFlujo = '10-15 L/min - Mascarilla facial de oxígeno con bolsa reservorio - 80% oxígeno';
                break;
            default:
                $dispositivoFlujo = 'Desconocido';
        }

        $duracion = ( ($presion - 200 ) * $tipoCilindro ) / $flujo;

        $duracion = $this->minutosAHoras($duracion);

        return view('index', compact('duracion','presion', 'letraTipoCilindro', 'tipoCilindro', 'flujo', 'dispositivoFlujo'));
    }

    private function minutosAHoras($minutos)
    {
        $horas = floor($minutos / 60);
        $min = $minutos % 60;

        return sprintf('%02d:%02d', $horas, $min);
    }
    
    public function calcularReposicionLiquidos(Request $request)
    {

        $cte = 4; // Parkland: 4 ml por kg por % de SCTQ

        $peso = $request->peso;
        //$SCTQ = 64;

        if ($request->sctq != null) {
            $SCTQ = $request->sctq;
        } else {
            $SCTQ = $request->cabeza + $request->torax + $request->brazos + $request->piernas + $request->manos + $request->pies + $request->genitales;
        }

        $volumen24 = $cte * $peso * $SCTQ;
        $volumen24F = number_format($volumen24, 0, '.', ',');
        $volumen8 = $volumen24 * 0.50;
        $volumen8F = number_format($volumen8, 0, '.', ',');        
        $volumen1 = $volumen8 / 8;
        $volumen1F = number_format($volumen1, 0, '.', ',');
        $volumen1min = $volumen1 / 60;
        $volumen1minF = number_format($volumen1min, 2, '.', ',');
        $volumenNormogotero = $volumen1min * 20;
        $volumenNormogoteroF = number_format($volumenNormogotero, 2, '.', ',');

        return view('index', compact('peso', 'SCTQ', 'volumen24F','volumen8F','volumen1F','volumen1minF','volumenNormogoteroF'));

    }    

}
