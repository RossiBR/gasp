<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Associado;
use App\InsigniaMadeira;
use App\ContratoVoluntario;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/asso', 'AssociadoController@index')->name('asso');		

function convert_utf8( $string ) { 
    //if ( strlen(utf8_decode($string)) == strlen($string) ) {   
        // $string is not UTF-8
		Log::info(mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));
        return mb_convert_encoding($string, "UTF-8");
    //} else {
        // already UTF-8
        //return $string;
    //}
}

function ramo($nome) {
	if ('Lobinho' == $nome) {
		return 1;
	} else if ('Escoteiro' == $nome) {
		return 2;
	} else if ('Sênior' == $nome) {
		return 3;
	} else if ('Pioneio' == $nome) {
		return 4;
	} else {
		return null;
	}
}

function linhaFormacao($nome) {
	if ('Dirigente' == $nome) {
		return 1;
	} else if ('Escotista' == $nome) {
		return 2;	
	} else {
		return null;
	}
}

Route::post('/test', function (Request $request) {
	 try {
	 	ini_set("memory_limit","1G");
	 	ini_set('max_execution_time', '900');
ini_set('max_input_time', '0');
set_time_limit(0);
ignore_user_abort(true);  
            if ($request->hasFile('file')) {
                $file = $request->file;
				$fileName =  date( "Y-m-d_H-i-s", time()) . '.xlsx';
				Log::info('-------------------------------------------------------------------');
				Log::info("uploaded file:");
				Log::info($file);

				
                if ($path = $file->storeAs('.', $fileName) && $file->isValid()) {                    
                    Excel::load('storage/app/'.$fileName, function($reader) {
                    
                    	$reader->each( function($sheet) {
                    		//Log::info('processing sheet: ' . $sheet);
                			Log::info('processing sheet title: ' . $sheet->getTitle());
					

							if ($sheet->getTitle() == 'Sheet0') {
								foreach ($sheet as $row) {
								
									Log::info('processing row: ' . $row);
									
									if ($row->categoria_1o_funcao == 'Escotista' || $row->categoria_1o_funcao == 'Dirigente') {

										$parse = explode(" ", $row->registro);
										$registro = $parse[0];
										$digito = $parse[2];
										
										$associado = Associado::where('registro', $registro)->first();
										Log::info('associado: ' . $associado);
										if ($associado) {
											Log::info('registro encontrado: ' . $registro);
											$associado->registro = $registro;
											$associado->registro_digito = $digito;
											
											Log::info('encoding UTF-8: ' . mb_check_encoding($row->nome_do_associado, 'UTF-8'));
											Log::info('encoding ISO-8859-1: ' . mb_check_encoding($row->nome_do_associado, 'ISO-8859-1'));
																					
											$associado->nome = convert_utf8(str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($row->nome_do_associado)))));
											Log::info($associado->nome);
											if ($row->e_mail) {
												$associado->email = convert_utf8(strtolower($row->e_mail));
											}
											Log::info($associado->email);
											$associado->uel = convert_utf8(str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($row->grupo)))));
											Log::info($associado->uel);
											$associado->save();
											Log::info('salvo');

										} else {								
											Log::info('registro nao encontrado: ' . $registro);
											$associado = new Associado;
											$associado->registro = $registro;
											$associado->registro_digito = $digito;

											Log::info('encoding UTF-8: ' . mb_check_encoding($row->nome_do_associado, 'UTF-8'));
											Log::info('encoding ISO-8859-1: ' . mb_check_encoding($row->nome_do_associado, 'ISO-8859-1'));
											
											$associado->nome = convert_utf8(str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($row->nome_do_associado)))));
											Log::info($associado->nome);
											if ($row->e_mail) {
												$associado->email = convert_utf8(strtolower($row->e_mail));
											}
											$associado->uel = convert_utf8(str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($row->grupo)))));
											$associado->save();
											Log::info('salvo');


										}
									} else {
										Log::info('associado nao elegivel: ' . $row->categoria_1o_funcao);
									}
								}
							} else if ($sheet->getTitle() == 'Sheet1') {
								foreach ($sheet as $row) {								
									Log::info('processing row: ' . $row);
									$parse = explode(" ", $row->registro);
									$registro = $parse[0];
									$digito = $parse[2];
										
									$associado = Associado::where('registro', $registro)->first();
									Log::info('associado: ' . $associado);
									if ($associado) {									
										$ramo=ramo($row->ramo);
										$linhaFormacao=linhaFormacao($row->linha_formacao);

										Log::info('ramo : ' . $ramo);
										Log::info('linha : ' . $linhaFormacao);

										$ims = InsigniaMadeira::with('ramo', 'linha_formacao')
										->where([
										    ['associado_id', '=', $associado->id],
										    ['ramo_id', '=', $ramo],
										    ['linha_formacao_id', '=', $linhaFormacao],
										])									
										->get();
										if (sizeof($ims) < 1) {
											$im = new InsigniaMadeira;
											$im->associado_id = $associado->id;
											$im->ramo_id = $ramo;
											$im->linha_formacao_id = $linhaFormacao;
											if ($row->ano) {
												$im->ano = $row->ano;
											}
											$im->save();
										} else {
											$im = InsigniaMadeira::find($ims[0]->id);
											if ($row->ano) {
												$im->ano = $row->ano;
											}
											$im->save();
										}

										Log::info('associado im : ' . $ims);

									} else {
										Log::info('im para associado inexistente  ' . $associado);
									}

								}
							} else if ($sheet->getTitle() == 'Sheet2') {
								foreach ($sheet as $row) {								
									Log::info('processing row: ' . $row);
									if ($row->registro) {
										$parse = explode(" ", $row->registro);
										$registro = $parse[0];
										$digito = $parse[2];

										$associado = Associado::where('registro', $registro)->first();
										Log::info('associado: ' . $associado);
										if ($associado) {
											$contratos = ContratoVoluntario::where([['associado_id', '=',$associado->id]])->get();
												Log::info($contratos);
												$found = 0;
												foreach ($contratos as $contrato) {
													if ($contrato->data_fim == $row->data_fim) {
														$found = 1;
													} else {
														$contrato->delete();
													}
												}
												if (!$found) {
													Log::info('novo contrato');
													$contrato = new ContratoVoluntario;
													$contrato->data_inicio = $row->contrato_data_inicio;
													$contrato->data_fim = $row->contrato_data_fim;
													$contrato->associado_id = $associado->id;
													$contrato->save();
												}
										}

									}
								}
							}

                    	});
                    	                    	
                    });




                    return "File sucessfully uploaded: " . $fileName;
                }



                throw new Exception('File was\'nt uploaded!');
            }

            throw new Exception('Request has\'nt got any file!');
        } catch (Exception $e) { // in App\Exceptions\Handler's render() method, add your own exception before parent's rendering
        	Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            return response()->error($e->getMessage());
        }
    
});

function upload($callback, Request $request) {
	

}


Route::post('/uploadassociados', function (Request $request) {
	 try {
	 	ini_set("memory_limit","1G");
	 	ini_set('max_execution_time', '900');
		ini_set('max_input_time', '0');
		set_time_limit(0);
		ignore_user_abort(true);  
            if ($request->hasFile('file')) {
                $file = $request->file;
				$fileName =  date( "Y-m-d_H-i-s", time()) . '.xlsx';
				Log::info('-------------------------------------------------------------------');
				Log::info("uploaded file:");
				Log::info($file);

				
                if ($path = $file->storeAs('.', $fileName) && $file->isValid()) {                    
                    Excel::load('storage/app/'.$fileName, function($reader) {
                    
                    	$reader->each( function($sheet) {
                    		//Log::info('processing sheet: ' . $sheet);
                			Log::info('processing sheet title: ' . $sheet->getTitle());
					

							if ($sheet->getTitle() == 'Sheet0') {
								foreach ($sheet as $row) {
								
									Log::info('processing row: ' . $row);
									
									if ($row->categoria_1o_funcao == 'Escotista' || $row->categoria_1o_funcao == 'Dirigente') {

										$parse = explode(" ", $row->registro);
										$registro = $parse[0];
										$digito = $parse[2];
										
										$associado = Associado::where('registro', $registro)->first();
										Log::info('associado: ' . $associado);
										if ($associado) {
											Log::info('registro encontrado: ' . $registro);
											$associado->registro = $registro;
											$associado->registro_digito = $digito;
											
											Log::info('encoding UTF-8: ' . mb_check_encoding($row->nome_do_associado, 'UTF-8'));
											Log::info('encoding ISO-8859-1: ' . mb_check_encoding($row->nome_do_associado, 'ISO-8859-1'));
																					
											$associado->nome = convert_utf8(str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($row->nome_do_associado)))));
											Log::info($associado->nome);
											if ($row->e_mail) {
												$associado->email = convert_utf8(strtolower($row->e_mail));
											}
											Log::info($associado->email);
											$associado->uel = convert_utf8(str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($row->grupo)))));
											Log::info($associado->uel);
											$associado->save();
											Log::info('salvo');

										} else {								
											Log::info('registro nao encontrado: ' . $registro);
											$associado = new Associado;
											$associado->registro = $registro;
											$associado->registro_digito = $digito;

											Log::info('encoding UTF-8: ' . mb_check_encoding($row->nome_do_associado, 'UTF-8'));
											Log::info('encoding ISO-8859-1: ' . mb_check_encoding($row->nome_do_associado, 'ISO-8859-1'));
											
											$associado->nome = convert_utf8(str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($row->nome_do_associado)))));
											Log::info($associado->nome);
											if ($row->e_mail) {
												$associado->email = convert_utf8(strtolower($row->e_mail));
											}
											$associado->uel = convert_utf8(str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($row->grupo)))));
											$associado->save();
											Log::info('salvo');


										}
									} else {
										Log::info('associado nao elegivel: ' . $row->categoria_1o_funcao);
									}
								}
							} 

                    	});
                    	                    	
                    });




                    return "File sucessfully uploaded: " . $fileName;
                }



                throw new Exception('File was\'nt uploaded!');
            }

            throw new Exception('Request has\'nt got any file!');
        } catch (Exception $e) { // in App\Exceptions\Handler's render() method, add your own exception before parent's rendering
        	Log::error($e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage());
            return response()->error($e->getMessage());
        }
    
});


Route::group([	
	'middleware' => 'auth'
	], function () {
		Route::resource('contratos', 'ContratoVoluntarioController');		
		Route::resource('associados', 'AssociadoApiController');
		Route::resource('ramos', 'RamoController');
		Route::resource('linhasformacao', 'LinhaFormacaoController');
		Route::resource('insigniamadeira', 'InsigniaMadeiraController');
		Route::resource('uel', 'UELController');
	}
);



