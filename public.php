	
		function metodoAlternativo () {
	
}
	
	public function up_ploadIracis($value='')
	{
		if(isset($_FILES['file']['name'])){
    		require_once APPPATH."/hooks/SimpleXLSX/SimpleXLSX.php";
			$periodo = $this->security->xss_clean( $this->input->post('periodo',FALSE));
			$mes     = $this->security->xss_clean( $this->input->post('mes',FALSE));
			$Empresa = $this->security->xss_clean( $this->input->post('Social',FALSE));
			$rucEmpresa = $this->security->xss_clean( $this->input->post('rucEmpresa',FALSE));
	    	$arrayCompraVenta = $arrayContri;
			$data = array();
			if ( $xlsx = SimpleXLSX::parse( $_FILES['file']['tmp_name'] ) ) {

					$x = $xx = 1;
					$tipoIdentificacion = $totalCantidad = $totalagregado = $totalanulados = 0;
					$totalfalladas = array();

						
						$nombrefichero = './fichero/'.$Empresa.'ficheroIracis.txt';
						$val = 'a';
						if (file_exists($nombrefichero)) {
							unlink('./fichero/'.$Empresa.'ficheroIracis.txt');
							$val = 'wa';
						}

						if ($archivo = fopen($nombrefichero, $val)) {

							/** traer todos los comprovantes  */
							$this->db->select('CONCAT(Timbrado,"-", Factura_Compra) as Factura_Compra,CONCAT(Timbrado,"-", Factura_Venta) as Factura_Venta,CONCAT(Timbrado,"-", Num_Factura) as Num_Factura');
							$this->db->where('Anho', $periodo);
							$query1 = $this->db->get($Empresa.'_acientos');
							$arrayCompraVenta = $query1->result_array();
				
							/** traer todos los proveedores  */
							$this->db->select('Ruc,idProveedor');
							$query = $this->db->get('proveedor');
							$arrayContri = $query->result_array();
							// var_dump($arrayContri);
      						//////////////////////////////////////
							// CICLO DE CANTIDAD DE hOJAS  count($xlsx->sheetNames())
							for ($i=0; $i < count($xlsx->sheetNames()); $i++) {
								// Si el ruc concide con la empresa se procede la verificacion
								$rucxlsx = $xlsx->rows(0)[0][5].'-'.$xlsx->rows(0)[0][6];
								$bander = true;
								list( $num_cols, $num_rows ) = $xlsx->dimension($i);

								var_dump($num_cols);

								if($rucEmpresa == $rucxlsx){
									// Determina el número de columnas a procesar, asegurando que el máximo sea 14 o 19
									$num_c = ($num_cols > 8) ? 14 : $num_cols;
									$item                        = $val = $control = $clave = 0;
									$cant_col                    = $num_rows;
									$Tipo = $xlsx->rows(0)[0][3]; // cabecera venta o compra
									// Si el número de columnas es 19, enviamos la hoja al método alternativo
									if ($num_c == 19) {
										$this->metodoAlternativo($xlsx->rows($i)); // Llama a otro método y pasa la hoja actual
										continue; // Salta al siguiente ciclo para evitar procesamiento adicional
									}
									if ($num_c > 10) {  // comprovar si la hoja cuuple con la cantidad de columna
										$fila_numero = 0; // Inicializamos el contador de filas
	
										foreach ( $xlsx->rows( $i ) as $k => $r  ) {
											$fila_numero++;
											$bander = true;

											if ($fila_numero > 3) {
												if (strlen($r[14]) != 8) {
													$totalfalladas[] = '<code>' . $r[14] . '</code> Timbrado Incorrecto  Fila ' . $fila_numero;
													$bander = false;
												}

												if (!$this->validarFecha($r[5], 'Y-m-d')) {
													$totalfalladas[] = $r[5] . ' no es una fecha válida en el formato especificado  Fila ' . $fila_numero;
													$bander = false;
												}

												if ($periodo !== substr($r[5], 0, 4)) {
													$totalfalladas[] = 'Periodo Seleccionado '.$periodo.'  Fecha Exel '.$r[5];
													$bander = false;
												}

                                                if (!preg_match('/^\d{3}-\d{3}-\d{7}$/', $r[4])) {
                                                    if (strlen($r[4]) > 15) {
                                                        // Encuentra la posición del segundo guion
                                                        $posSegundoGuion = strpos($r[4], '-', strpos($r[4], '-') + 1);
                                                        // Elimina el primer cero después del segundo guion
                                                        if ($r[4][$posSegundoGuion + 1] == '0') {
                                                            $r[4] = substr_replace($r[4], '', $posSegundoGuion + 1, 1);
                                                        }
                                                    } else {
                                                        $totalfalladas[] = 'Fila ' . $fila_numero . ' : <code>' . $r[4] . '</code>. La factura debe seguir el formato XXX-XXX-XXXXXXX';
                                                        $bander = false;
                                                    }
                                                }
                                                
											}
											if (is_int($r[3]) && $r[3] < 3 && $bander == true):
                                                        // 911-COMPRAS y 921-VENTAS
														switch ($Tipo) {
															case 911: // se refiera ala compra en la set tributaria
                                                                // var_dump($r );
                                                                // exit;

																$ruc = $r[0].'-'.$r[1];
																$r[4] = substr($r[4], 0, 8).substr($r[4], 8);
																

																if ($r[11] > 0 ){ // si el monto total es mayor a cero 
																	$indice = array_search($r[14].'-'.$r[4] , array_column($arrayCompraVenta, 'Factura_Compra'));
																	if(empty($indice)){
																		/** comprbar si existe contribuyente sino agregar */
                                                                        if (is_int($r[1]) && $r[0] !== 4444401):
                                                                            if ($r[1] >= 0):
                                                                                $tipoIdentificacion = 11;
                                                                            else:
                                                                                $tipoIdentificacion = 12;
                                                                                $ruc = $r[0];
                                                                            endif;

                                                                            $idContri = array_search($ruc, array_column($arrayContri, 'Ruc', 'idProveedor'));

                                                                            if (empty($idContri)):
                                                                                $object = array(
                                                                                    'Ruc' => $ruc,
                                                                                    'Razon_Social' =>  $r[2],
                                                                                );
                                                                                $this->db->insert('proveedor', $object);
                                                                                $idContri = $this->db->insert_id();
                                                                                $arrayContri[] = array('Ruc' => $ruc, 'idProveedor' => $idContri);
                                                                            endif;
                                                                        else:
                                                                            if (in_array($r[0], [4444401, 2230354, 4603896,'X         ','X'])) :
                                                                                $tipoIdentificacion = 15;
                                                                                $idContri = 1668;
                                                                                $ruc  = 'X';
                                                                                $r[0] = 'X';
                                                                                $r[2] = 'SIN NOMBRE';
                                                                            else:
                                                                                $tipoIdentificacion = 12;
                                                                                $ruc = $r[0];
                                                                                $idContri = array_search($ruc, array_column($arrayContri, 'Ruc', 'idProveedor'));
                                                                                
                                                                                if (empty($idContri)):
                                                                                    $object = array(
                                                                                        'Ruc' => $ruc,
                                                                                        'Razon_Social' =>  $r[2],
                                                                                    );
                                                                                    $this->db->insert('proveedor', $object);
                                                                                    $idContri = $this->db->insert_id();
                                                                                    $arrayContri[] = array('Ruc' => $ruc, 'idProveedor' => $idContri);
                                                                                endif;
                                                                            endif;
                                                                        endif;
        
                                                                            if ($r[3] == 2):
                                                                                
                                                                                $cuotas = 1;
                                                                                $name = '[2.01.01.01] PROVEEDORES LOCALES [CORTO PLAZO]';
                                                                            else:
                                                                            
                                                                                $cuotas = 0;
                                                                                $name = '[1.01.01.02] CAJA';
        
                                                                            endif;

                                                                            $dataPlan = array();
        
        
                                                                            // Compras mercaderias al 10%
                                                                            if (round($r[6]) > 0):
        
                                                                                $data                             = array(
                                                                                    'Debe'                            => round($r[6]),
                                                                                    'Haber'                           => 0,
                                                                                'Fecha_Plan'                      => $r[5],
                                                                                'name'    => '[1.01.04.01.01] MERCADERIAS  GRAVADAS POR EL IVA AL 10%'
                                                                                );
                                                                                $dataPlan[] = $data;
                                                
                                                                            endif;
																		// Compras mercadeiva5rias al 5%
																		if (round($r[8]) > 0):
																			$data                             = array(
																				'Debe'                            => round($r[8]),
																				'Haber'                           => 0,
																			'Fecha_Plan'                      => $r[5],
																			'name'    => '[1.01.04.01.02]MERCADERIAS  GRAVADAS POR EL IVA AL 5%'
																		);
																			$dataPlan[] = $data;
																		endif;
																		// Compras mercaderias excentas
																		if (round($r[10]) > 0):
																			$data                             = array(
																				'Debe'                            =>  round($r[10]),
																				'Haber'                           => 0,
																			'Fecha_Plan'                      => $r[5],
																			'name'    => '[1.01.04.01.03] MERCADERIAS  EXENTAS DEL IVA'
											
											
																			);
																			$dataPlan[] = $data;
																		endif;
														
																		if (round($r[7]+$r[9]) > 0) :
																		// Esta parte es para insercion del iva
																			$data                             = array(
																			'Debe'                           => round($r[7]+$r[9]),
																			'Haber'                           => 0,
																			'Fecha_Plan'                      => $r[5],
																			'name'    => '[1.01.03.05.03] IVA-CREDITO FISCAL'
																		
																			);
																			$dataPlan[] = $data;				
																		endif;
	
																		$data                             = array(
																			'Debe'                           => 0,
																			'Haber'                           => round($r[11]),
																			'Fecha_Plan'                      => $r[5],
	
																			'name'    => $name
																		  );
																		  $dataPlan[] = $data;
	
																		/** finich */
																		$Factura_Compra = $r[4];
																		$Num_Factura  = null;
                                                                        /** finich */
                                                                        $data =  array(
                                                                            'id'          => $x++,
                                                                            'date'        => $r[5],
                                                                            'comprovante' => $r[4],
                                                                            'documentos'  => $r[3],
                                                                            'Mes'         => date('m',strtotime($r[5])),
                                                                            'Ruc'         => $ruc, 
                                                                            'Excenta'     => round($r[10]),
                                                                            'iva5'        => round($r[9]), 
                                                                            'iva10'       => round($r[7]), 
                                                                            'desc'        => '',
                                                                            'montototal'  => round($r[11]),  
                                                                            'Incluido10'  => round($r[6]+$r[7]), 
                                                                            'grabadas10'  => round($r[6]),
                                                                            'grabadas5'   => round($r[8]),
                                                                            'incluidas5'  => round($r[8]+$r[9]),
                                                                            'qty'         => $Empresa,
                                                                            'descuento'   => $periodo,
                                                                            'Tipo'		  => $Tipo,
                                                                            'Proveedor_idProveedor'=> $idContri,
                                                                            'condicion'                    => $r[12],
                                                                            'Timbrado'                      => $r[14],
                                                                            'Cuotas'                        => $r[13],
                                                                            'RucCliente'                 => $r[0],
                                                                            'DV'                 => $r[1],
                                                                            'Factura_Compra'                 => $Factura_Compra,
                                                                            'Factura_Venta'                 => null,
                                                                            'Num_Factura'  => $Num_Factura,
                                                                            'tales'   => round($r[7]+$r[9]),
																			'tipoIdentificacion'   => $tipoIdentificacion,
																			'tipoDocumento'   => 109, // factura
                                                                            'data'                         => $dataPlan
                                                                        );
                                                                        /////////////////////////////////////////////
                                                                        fwrite($archivo, json_encode($data). ",");
                                                                        $totalagregado ++;
                                                                        ///////////////////////////////////////////////
						
																	}else{
																		// guardar las factura no insertadas o ya existentes
                                                                        $totalfalladas[] = 'Factura Ya Insertadas: <code>' . $r[4].'</code> Fila exel '.$fila_numero;
													
																	}
																}else{ 
																	// $indice = array_search($r[14].'-'.$r[4] , array_column($arrayCompraVenta, 'Num_Factura'));
																	// if(empty($indice)){
																	// 	$dataPlan = [];
																	// 	$Num_Factura = $r[4];
																	// 	$Factura_Compra  = null;
																	// /** finich */
																	// $data =  array(
																	// 	'id'          => $x++,
																	// 	'date'        => $r[5],
																	// 	'comprovante' => $r[4],
																	// 	'documentos'  => $r[3],
																	// 	'Mes'         => date('m',strtotime($r[5])),
																	// 	'Ruc'         => $ruc, 
																	// 	'Excenta'     => round($r[10]),
																	// 	'iva5'        => round($r[9]), 
																	// 	'iva10'       => round($r[7]), 
																	// 	'desc'        => '',
																	// 	'montototal'  => round($r[11]),  
																	// 	'Incluido10'  => round($r[6]+$r[7]), 
																	// 	'grabadas10'  => round($r[6]),
																	// 	'grabadas5'   => round($r[8]),
																	// 	'incluidas5'  => round($r[8]+$r[9]),
																	// 	'qty'         => $Empresa,
																	// 	'descuento'   => $periodo,
																	// 	'Tipo'		  => $Tipo,
																	// 	'Proveedor_idProveedor'=> $idContri,
																	// 	'condicion'                    => $r[12],
																	// 	'Timbrado'                      => $r[14],
																	// 	'Cuotas'                        => $r[13],
																	// 	'RucCliente'                 => $r[0],
																	// 	'DV'                 => $r[1],
																	// 	'Factura_Compra'                 => $Factura_Compra,
																	// 	'Factura_Venta'                 => null,
																	// 	'Num_Factura'  => $Num_Factura,
																	// 	'tales'   => round($r[7]+$r[9]),
                                                                    //     'tipoIdentificacion'   => $tipoIdentificacion,
																	// 	'tipoDocumento'   => 109, // factura
																	// 	'data'                         => $dataPlan
																	// );
																	// /////////////////////////////////////////////
																	// fwrite($archivo, json_encode($data). ",");
																	// $totalagregado ++;
																	// ///////////////////////////////////////////////
																	// }
																	$totalanulados ++;
                                                                    $totalfalladas[] = 'Factura Anulado: <code>' . $r[4].'</code> Fila '.$fila_numero;
																}
																# factura compra
																
	
	
													
																break;
															case 921:
																# factura venta
																$ruc = $r[0].'-'.$r[1];
																$r[4] = substr($r[4], 0, 8).substr($r[4], 8);

																if ($r[11] > 0){ // si el monto total es mayor a cero 

																	// verifico si la factura existe
																	$indice = array_search($r[14].'-'.$r[4], array_column($arrayCompraVenta, 'Factura_Venta'));

																	if(empty($indice)){

																		/** comprbar si existe contribuyente sino agregar */
																		if (is_int($r[1]) && $r[0] != 4444401 && $r[0] != 2230354 && $r[0] != 4603896):

																						/** si  tiene identificador es tipo Ruc */
																						if ($r[1] >= 0):
		
			 																					$tipoIdentificacion = 11;
																							
																						else:
																							/** sino  es tipo documento */
																								$tipoIdentificacion = 12;
																								$ruc = $r[0];
																						endif;
																						$idContri = array_search($ruc, array_column($arrayContri, 'Ruc','idProveedor'));
												
																						if (empty($idContri)):
																							# code... si no existe insertar new comtribuyente
																							$object = array(
																								'Ruc' => $ruc,
																								'Razon_Social' =>  $r[2],
																								);
																							$this->db->insert('proveedor', $object);
																							$idContri = $this->db->insert_id();
																							$arrayContri[] = array('Ruc' => $ruc,'idProveedor' => $idContri);
																						endif;
																		else:
																			
                                                                            if (in_array($r[0], [4444401, 2230354, 4603896,'X         ','X'])) {
                                                                                $tipoIdentificacion = 15;
                                                                                $idContri = 1668;
                                                                                $ruc  = 'X';
                                                                                $r[0] = 'X';
                                                                                $r[2] = 'SIN NOMBRE';
                                                                            } else {
                                                                                $tipoIdentificacion = 12;
                                                                                $ruc = $r[0];
                                                                                $idContri = array_search($ruc, array_column($arrayContri, 'Ruc','idProveedor'));
                                                                                if (empty($idContri)) {
                                                                                    $object = array(
                                                                                        'Ruc' => $ruc,
                                                                                        'Razon_Social' =>  $r[2]
                                                                                    );
                                                                                    $this->db->insert('proveedor', $object);
                                                                                    $idContri = $this->db->insert_id();
                                                                                    $arrayContri[] = array('Ruc' => $ruc, 'idProveedor' => $idContri);
                                                                                }
                                                                            }


																		endif;
												
	
																		if ($r[3] == 2):
																		
																			$cuotas = 1;
																			$name = '[1.01.03.01] DEUDORES POR VENTAS [CORTO PLAZO]';
																		else:
																			
																			$cuotas = 0;
																			$name = '[1.01.01.02] CAJA';
	
																		endif;
																		/** finich */
																		$dataPlan = array();
																		$data                             = array(
																			'Debe'                           => round($r[11]),
																			'Haber'                           => 0,
																			'Fecha_Plan'                      => $r[5],
	
																			'name'    => $name
																		  );
																		  $dataPlan[] = $data;
	
	
																		// Ventas mercaderias al 10%
																		if (round($r[6]) > 0):
	
																			$data                             = array(
																				'Debe'                            => 0,
																				'Haber'                           => round($r[6]),
																			'Fecha_Plan'                      => $r[5],
																			'name'    => '[4.01.01] VENTAS DE MERCADERÍAS GRAVADAS POR 10%'
																			);
																			$dataPlan[] = $data;
											
																		endif;
																		// Ventas mercadeiva5rias al 5%
																		if (round($r[8]) > 0):
																			$data                             = array(
																				'Debe'                            => 0,
																				'Haber'                           => round($r[8]),
																			'Fecha_Plan'                      => $r[5],
																			'name'    => '[4.01.02] VENTAS DE MERCADERÍAS GRAVADAS POR 5%'
																		);
																			$dataPlan[] = $data;
																		endif;
																		// Ventas mercaderias excentas
																		if (round($r[10]) > 0):
																			$data                             = array(
																				'Debe'                            => 0,
																				'Haber'                           => round($r[10]),
																			'Fecha_Plan'                      => $r[5],
																			'name'    => '[4.01.03] VENTAS DE MERCADERÍAS EXENTAS  DEL IVA'
											
											
																			);
																			$dataPlan[] = $data;
																		endif;
														
																		if (round($r[7]+$r[9]) > 0) :
																		// Esta parte es para insercion del iva
																			$data                             = array(
																			'Debe'                           => 0,
																			'Haber'                           => round($r[7]+$r[9]),
																			'Fecha_Plan'                      => $r[5],
																			'name'    => '[2.01.03.01.02] IVA-DEBITO FISCAL'
																		
																			);
																			$dataPlan[] = $data;				
																		endif;
																		$Factura_Venta = $r[4];
																		$Num_Factura  = null;
																		$data =  array(
																			'id'          => $x++,
																			'date'        => $r[5],
																			'comprovante' => $r[4],
																			'documentos'  => $r[3], // CONTADO CREDITO
																			'Mes'         => date('m',strtotime($r[5])),
																			'Ruc'         => $ruc, 
																			'Excenta'     => round($r[10]),
																			'iva5'        => round($r[9]), 
																			'iva10'       => round($r[7]), 
																			'desc'        => '',
																			'montototal'  => round($r[11]),  
																			'Incluido10'  => round($r[6]+$r[7]), 
																			'grabadas10'  => round($r[6]),
																			'grabadas5'   => round($r[8]),
																			'incluidas5'  => round($r[8]+$r[9]),
                                                                            
																			'qty'         => $Empresa,
																			'descuento'   => $periodo,
																			'Tipo'		  => $Tipo,
																			'Proveedor_idProveedor'=> $idContri,
																			'condicion'                    => $r[12],
																			'Timbrado'                      => $r[14],
																			'Cuotas'                        => $cuotas ,
																			'RucCliente'                 => $r[0],
																			'DV'                 => $r[1],
																			'Factura_Venta'                 => $Factura_Venta,
																			'Factura_Compra'                 => null,
																			'Num_Factura'  => $Num_Factura,
																			'tales'   => round($r[7]+$r[9]),

																			'tipoIdentificacion'   => $tipoIdentificacion,
																			'tipoDocumento'   => 109, // factura
																			'data'                         => $dataPlan
																		);
																		/////////////////////////////////////////////
																		fwrite($archivo, json_encode($data). ",");
																		$totalagregado ++;
																		///////////////////////////////////////////////
																	}else{
																		// guardar las factura no insertadas o ya existentes
                                                                        $totalfalladas[] = 'Factura Ya Insertadas: <code>' . $r[4].'</code> Fila exel '.$fila_numero;
													
																	}
																}else{ 
																	// $indice = array_search($r[14].'-'.$r[4] , array_column($arrayCompraVenta, 'Num_Factura'));
																	// if(empty($indice)){
																	// 	$dataPlan = [];
																	// 	$Num_Factura = $r[4];
																	// 	$Factura_Venta  = null;
																	// 	$data =  array(
																	// 		'id'          => $x++,
																	// 		'date'        => $r[5],
																	// 		'comprovante' => $r[4],
																	// 		'documentos'  => $r[3],  // CONTADO A CREDITO
																	// 		'Mes'         => date('m',strtotime($r[5])),
																	// 		'Ruc'         => $ruc, 
																	// 		'Excenta'     => round($r[10]),
																	// 		'iva5'        => round($r[9]), 
																	// 		'iva10'       => round($r[7]), 
																	// 		'desc'        => '',
																	// 		'montototal'  => round($r[11]),  
																	// 		'Incluido10'  => round($r[6]+$r[7]), 
																	// 		'grabadas10'  => round($r[6]),
																	// 		'grabadas5'   => round($r[8]),
																	// 		'incluidas5'  => round($r[8]+$r[9]),
																	// 		'qty'         => $Empresa,
																	// 		'descuento'   => $periodo,
																	// 		'Tipo'		  => $Tipo,
																	// 		'Proveedor_idProveedor'=> $idContri,
																	// 		'condicion'                    => $r[12],
																	// 		'Timbrado'                      => $r[14],
																	// 		'Cuotas'                        => $cuotas ,
																	// 		'RucCliente'                 => $r[0],
																	// 		'DV'                 => $r[1],
																	// 		'Factura_Venta'                 => $Factura_Venta,
																	// 		'Factura_Compra'                 => null,
																	// 		'Num_Factura'  => $Num_Factura,
																	// 		'tales'   => round($r[7]+$r[9]),
																	// 		'tipoIdentificacion'   => 12,
																	// 		'tipoDocumento'   => 109, // factura

																	// 		'data'                         => $dataPlan
																	// 	);
																		/////////////////////////////////////////////
																		// fwrite($archivo, json_encode($data). ",");
																		// $totalagregado ++;
																		// $totalanulados ++;
																		///////////////////////////////////////////////

																	// }else{
																		$totalanulados ++;
																		
																	// }
																}
																
	
	
	

																break;
														}
	

													
							
	
													$control = 1;
												// }
	
											endif;
											$totalCantidad ++;
	
										}
									}

								} else {
									echo json_encode(array("status" => false,"text" => 'El indicador RUC no coinside con la Empresa Seleccionada'));
									exit;
								}

							}

						//////////////////////////////////////////////////////////////////
								fclose($archivo);
						}
					if (!empty($data)) {	
						echo json_encode(array(
							"status" => true,
							"add" => $totalagregado,
							"tools" => $totalCantidad,
							"not" => $totalCantidad - $totalagregado,
							"nulos" => $totalanulados,
							"fallas" => $totalfalladas,

						
						));
						$this->session->set_userdata('alert',0);
						
					}else{
						echo json_encode(array(
							"status" => false,
							"text" => 'Los Datos no se han Importar. ',
							"fallas" => $totalfalladas,
						));
					}

					

			} else {
				echo SimpleXLSX::parseError();
			}
		}
	}
