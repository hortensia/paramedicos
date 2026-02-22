<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Calculadora TAMP</title>
        
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        
        <style>
            * {
                font-family: 'Inter', sans-serif;
            }
            
            body {
                background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
                min-height: 100vh;
                padding: 2rem 0;
            }
            
            .container-main {
                background: white;
                border-radius: 12px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                padding: 3rem;
            }
            
            .page-title {
                color: #043a90;
                font-weight: 700;
                margin-bottom: 2.5rem;
                text-align: center;
                font-size: 2.5rem;
            }
            
            .section-title {
                color: #043a90;
                font-weight: 700;
                margin-top: 2.5rem;
                margin-bottom: 1.5rem;
                font-size: 1.4rem;
                border-bottom: 3px solid #3b82f6;
                padding-bottom: 0.8rem;
            }
            
            .section-results {
                color: #043a90;
            }

            .form-label {
                color: #333;
                font-weight: 600;
                margin-bottom: 0.6rem;
                font-size: 0.95rem;
            }
            
            .form-control, .form-select {
                border: 2px solid #e0e0e0;
                border-radius: 8px;
                padding: 0.75rem;
                font-size: 0.95rem;
                transition: all 0.3s ease;
            }
            
            .form-control:focus, .form-select:focus {
                border-color: #3b82f6;
                box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
            }
            
            .btn-calculate {
                background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
                border: none;
                color: white;
                font-weight: 600;
                padding: 0.75rem 2.5rem;
                border-radius: 8px;
                font-size: 1rem;
                transition: all 0.3s ease;
                margin-top: 1rem;
            }
            
            .btn-calculate:hover {
                background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
            }
            
            .form-group {
                margin-bottom: 1.5rem;
            }
            
            .radio-group {
                display: flex;
                flex-direction: column;
                gap: 0.8rem;
            }
            
            .radio-option {
                display: flex;
                align-items: center;
                padding: 0.8rem;
                border-radius: 8px;
                border: 1px solid #e0e0e0;
                cursor: pointer;
                transition: all 0.2s ease;
            }
            
            .radio-option:hover {
                background-color: #f8f9ff;
                border-color: #3b82f6;
            }
            
            .radio-option input[type="radio"] {
                margin-right: 0.8rem;
                cursor: pointer;
                width: 1.2rem;
                height: 1.2rem;
            }
            
            .radio-option label {
                margin: 0;
                cursor: pointer;
                flex: 1;
                font-size: 0.95rem;
                color: #333;
            }
            
            .form-section {
                background: #f8f9fa;
                padding: 2rem;
                border-radius: 10px;
                border-left: 4px solid #3b82f6;
            }
            
            .row {
                margin-bottom: 1rem;
            }

            table{
                width:100%;
                border-collapse:collapse;
            }

            th, td{
                padding:15px;
                text-align:left;
            }

            th{
                width:50%;
                background:#f8f9fc;
                font-weight:600;
                color:#333;
            }

            td{
                background:#ffffff;
                color:#555;
            }

            tr:nth-child(even) th{
                background:#eef2ff;
            }

            tr:nth-child(even) td{
                background:#f9fafc;
            }            
            
            /* Navbar Styles */
            .navbar-custom {
                background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%) !important;
                box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
                position: sticky;
                top: 0;
                z-index: 999;
            }

            .navbar-custom .navbar-brand {
                font-weight: 700;
                font-size: 1.5rem;
                color: white !important;
                margin-right: 2rem;
            }

            .navbar-custom .nav-link {
                color: white !important;
                font-weight: 600;
                margin: 0 1rem;
                position: relative;
                transition: all 0.3s ease;
                font-size: 1rem;
            }

            .navbar-custom .nav-link::after {
                content: '';
                position: absolute;
                bottom: -5px;
                left: 0;
                width: 0;
                height: 2px;
                background: white;
                transition: width 0.3s ease;
            }

            .navbar-custom .nav-link:hover::after {
                width: 100%;
            }

            .navbar-custom .nav-link:hover {
                transform: translateY(-2px);
            }

            @media (max-width: 768px) {
                .container-main {
                    padding: 1.5rem;
                }
                
                .page-title {
                    font-size: 1.8rem;
                }
                
                .section-title {
                    font-size: 1.1rem;
                }

                .section-results {
                    color: #1e40af;
                }  

                .navbar-custom .nav-link {
                    margin: 0.5rem 0;
                    padding-left: 1rem !important;
                }
            }
        </style>
    </head>
    <body>
        <!-- Navbar Menu -->
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <span class="navbar-brand">
                    <i class="fas fa-calculator"></i> Calculadora TAMP
                </span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#duracionOxigeno">Duración Tanque de Oxígeno</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#reposicionLiquidos">Reposición de Líquidos en Quemaduras</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5 mb-5">
            <div class="container-main">
                
                <!-- Primera Sección: Duración Tanque Oxígeno -->
                <div class="form-section" id="duracionOxigeno">
                    <h2 class="section-title">
                        Duración Tanque de Oxígeno
                    </h2>

                    <form method="POST" action="{{ route('calcularDuracionOxigeno') }}" id="formDO">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="presion" class="form-label">Presión (PSI)*</label>
                                    <input type="number" name="presion" id="presion" class="form-control" placeholder="Ej: 2000" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label mb-3"><strong>Tipo de cilindro*</strong></label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" name="tipoCilindro" id="tipoCilindro1" value="0.16">
                                        <label for="tipoCilindro1">D (Cte 0.16) +</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="tipoCilindro" id="tipoCilindro2" value="0.28">
                                        <label for="tipoCilindro2">Jumbo D (Cte 0.28)</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="tipoCilindro" id="tipoCilindro3" value="0.26">
                                        <label for="tipoCilindro3">E (Cte 0.26) +</label>
                                    </div>                                                                        
                                    <div class="radio-option">
                                        <input type="radio" name="tipoCilindro" id="tipoCilindro4" value="2.41">
                                        <label for="tipoCilindro4">G (Cte 2.41)</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="tipoCilindro" id="tipoCilindro5" value="3.14">
                                        <label for="tipoCilindro5">H/K (Cte 3.14)</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="tipoCilindro" id="tipoCilindro6" value="1.56">
                                        <label for="tipoCilindro6">M (Cte 1.56) +</label>
                                    </div>                                                                        
                                </div>
                            </div>
                        </div>                        

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label mb-3"><strong>Flujo (Litros por minuto)*</strong></label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" name="flujo" id="flujo1" value="1">
                                        <label for="flujo1">1 L/min - Puntas nasales - 21-24% oxígeno</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="flujo" id="flujo2" value="2">
                                        <label for="flujo2">2 L/min - Puntas nasales - 25-28% oxígeno</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="flujo" id="flujo3" value="3">
                                        <label for="flujo3">3 L/min - Puntas nasales - 29-32%</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="flujo" id="flujo4" value="4">
                                        <label for="flujo4">4 L/min - Puntas nasales - 23-36% oxígeno</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="flujo" id="flujo5" value="5">
                                        <label for="flujo5">5 L/min - Puntas nasales - 37-40% oxígeno</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="flujo" id="flujo6" value="6">
                                        <label for="flujo6">6 L/min - Puntas nasales - 41-44% oxígeno</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="flujo" id="flujo10" value="10">
                                        <label for="flujo10">6-10 L/min - Mascarilla facial de oxígeno simple - 60% oxígeno</label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="flujo" id="flujo15" value="15">
                                        <label for="flujo15">10-15 L/min - Mascarilla facial de oxígeno con bolsa reservorio - 80% oxígeno</label>
                                    </div>                                                                                                            
                                </div>
                            </div>
                        </div>                        

                        <button type="submit" class="btn btn-calculate" name="calcularDO" id="calcularDO">
                            Calcular Duración
                        </button>

                        <br/>
                        <a id="resultadosDO"></a>                        
                        <br/>
                        <hr/>

                        <h3 class="section-results">Resultados Duración Tanque de Oxígeno</h3>

                        <h5>Duración = ( (Presión - 200) x Tipo de cilindro ) / Flujo</h5>

                        <table>
                            <tr>
                                <th>Presión</th>
                                <td>{{$presion ?? ''}} PSI</td>
                            </tr>
                            <tr>
                                <th>Tipo de cilindro</th>
                                <td>{{$letraTipoCilindro ?? ''}} ({{$tipoCilindro ?? ''}})</td>
                            </tr>
                            <tr>
                                <th>Flujo</th>
                                <td>{{$dispositivoFlujo ?? ''}}</td>
                            </tr>
                            <tr>
                                <th>Duración</th>
                                <td>{{$duracion ?? ''}} hora(s)</td>
                            </tr>                            
                        </table>

                        @if(isset($presion) && isset($duracion))
                            <script>
                                window.location.hash = 'resultadosDO';
                            </script>
                        @endif
                    </form>
                </div>

                <!-- Segunda Sección: Reposición de Líquidos -->
                <div class="form-section" style="margin-top: 2rem;" id="reposicionLiquidos">
                    <h2 class="section-title">
                        Reposición de Líquidos en Quemaduras
                    </h2>

                    <form method="POST" action="{{ route('calcularReposicionLiquidos') }}" id="formRL">
                        @csrf

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="peso" class="form-label">Peso (kg)*</label>
                                    <input type="number" name="peso" id="peso" class="form-control" placeholder="Ej: 95" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="peso" class="form-label">SCTQ (%)*</label>
                                    <input type="number" name="sctq" id="sctq" class="form-control" placeholder="Ej: 64">
                                </div>
                            </div>                                

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edad" class="form-label">Edad (años)</label>
                                    <input type="number" name="edad" id="edad" class="form-control" placeholder="Ej: 25">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                </div>
                            </div> 
                            
                            <hr/>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label mb-3"><strong>Cabeza</strong></label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" name="cabeza" id="cabeza1" value="9">
                                            <label for="cabeza1">Completa (adelante y atrás) - 9%</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="cabeza" id="cabeza2" value="4.5">
                                            <label for="cabeza2">Media (adelante o atrás) - 4.5%</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="cabeza" id="cabeza3" value="2.25">
                                            <label for="cabeza3">1/4 (adelante o atrás) - 2.25%</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label mb-3"><strong>Tronco</strong></label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" name="torax" id="torax1" value="36">
                                            <label for="torax1">Completo (adelante y atrás) - 36%</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="torax" id="torax2" value="18">
                                            <label for="torax2">Medio (adelante o atrás) - 18%</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="torax" id="torax3" value="9">
                                            <label for="torax3">1/4 (adelante o atrás) - 9%</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label mb-3"><strong>Brazos</strong></label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" name="brazos" id="brazos0" value="18">
                                            <label for="brazos0">2 brazos (adelante y atrás) - 18%</label>
                                        </div>                                        
                                        <div class="radio-option">
                                            <input type="radio" name="brazos" id="brazos1" value="9">
                                            <label for="brazos1">1 brazo completo (adelante y atrás) - 9%</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="brazos" id="brazos2" value="4.5">
                                            <label for="brazos2">1/2 brazo (adelante o atrás) - 4.5%</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="brazos" id="brazos3" value="2.25">
                                            <label for="brazos3">1/4 brazo (adelante o atrás) - 2.25%</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label mb-3"><strong>Piernas</strong></label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" name="piernas" id="piernas0" value="36">
                                            <label for="piernas0">2 piernas completas (adelante y atrás) - 36%</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="piernas" id="piernas1" value="18">
                                            <label for="piernas1">1 pierna completa (adelante y atrás) - 18%</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="piernas" id="piernas2" value="9">
                                            <label for="piernas2">1/2 pierna (adelante o atrás) - 9%</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="piernas" id="piernas3" value="4.5">
                                            <label for="piernas3">1/4 pierna (adelante o atrás) - 4.5%</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label mb-3"><strong>Manos</strong></label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" name="manos" id="manos1" value="2">
                                            <label for="manos1">2 manos completas - 2%</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="manos" id="manos2" value="1">
                                            <label for="manos2">1 mano completa - 1%</label>
                                        </div>                                                                                
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label mb-3"><strong>Pies</strong></label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" name="pies" id="pies1" value="2">
                                            <label for="pies1">2 pies completos - 2%</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="pies" id="pies2" value="1">
                                            <label for="pies2">1 pie completo - 1%</label>
                                        </div>                                                                                
                                    </div>
                                </div>
                            </div>                            
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label mb-3"><strong>Genitales</strong></label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" name="genitales" id="genitales1" value="1">
                                            <label for="genitales1">Genitales - 1%</label>
                                        </div>
                                    </div>
                                </div>
                            </div>                            

                        </div>

                        <button type="submit" class="btn btn-calculate" name="calcularRL" id="calcularRL">
                            Calcular Reposición (Fórmula de Parkland)
                        </button>

                        <br/>
                        <a id="resultadosRL"></a>                        
                        <br/>
                        <hr/>

                        <h3 class="section-results">Resultados Reposición de Líquidos en Quemaduras</h3>

                        <h5>Fórmula de Parkland: Volumen (ml) = 4 ml x peso (kg) x SCTQ (%)</h5>

                        <table>
                            <tr>
                                <th>Peso</th>
                                <td>{{$peso ?? ''}} Kg</td>
                            </tr>
                            <tr>
                                <th>SCTQ (Superficie Corporal Total Quemada)</th>
                                <td>{{$SCTQ ?? ''}} %</td>
                            </tr>
                            <tr>
                                <th>Volumen 24 horas</th>
                                <td>{{$volumen24F ?? ''}} ml en 24 horas</td>
                            </tr>
                            <tr>
                                <th>Volumen 8 horas</th>
                                <td>{{$volumen8F ?? ''}} ml en 8 horas</td>
                            </tr>
                            <tr>
                                <th>Volumen 1 hora</th>
                                <td>{{$volumen1F ?? ''}} ml en 1 hora</td>
                            </tr>
                            <tr>
                                <th>Volumen 1 minuto</th>
                                <td>{{$volumen1minF ?? ''}} ml en 1 minuto</td>
                            </tr>
                            <tr>
                                <th>Volumen Normogotero</th>
                                <td>{{$volumenNormogoteroF ?? ''}} gotas por minuto</td>
                            </tr>                                                        
                        </table>

                        @if(isset($peso) && isset($volumen24F))
                            <script>
                                window.location.hash = 'resultadosRL';
                            </script>
                        @endif

                    </form>
                </div>

            </div>
        </div>

        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
