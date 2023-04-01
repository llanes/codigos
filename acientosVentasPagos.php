
          <div class="add_libros"   >

          <!-- contenido de formulario -->
          <input type="hidden" class="" name="cantidad_debe" id="cantidad_debe" value="0"/>
          <input type="hidden" class="" name="cantidad_haber" id="cantidad_haber" value="2">
          <input type="hidden" class="limpiar" id="buscaprfecha" name="Mes"  value=""/>
          
          
          
          
          <div class=" panel-default cls-panel ">
            <div class='close01'>
            <div class="col-md-7 .ol-md-offset-0" id="combodeclaracion">
              <div id="Contenedor1" class="panel panel-default cls-panel  col-md-12 contenDebe">
          
                <div id="2div_0" class="add_div">
                  <div class="form-group col-md-6">
                    <label id="select1">*Aciento Debe</label>
                    <div class="input-group input-group-sm">
          
                      <select id="pagosde0" required class="singlet_2 form-control PlandeCuenta" name="pagosde0" data-fila="selectiomimuesto0" title="Seleccione un Plan de Cuenta" autofocus>
                      </select>
                    </div>
                    <span class ="PPP text-red"  id="id_del_div"style="font-size: 10px"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
                  </div>
                  <div class="form-group col-md-2">
                    <label>* Monto Grav.</label>
                    <div class="input-group input-group-sm">
          
                      <input    type ="text" data-id="0" id="money0" name="money0" class="form-control money0 monto  limpiar" required autofocus onkeyup="jquerycontrol(this)"  >
                      <input type="hidden" name="montoInput0" id="montoInput0" class="montoInput0 limpiar" value="">
                    </div>
          
                    <span class ="AP text-red"  id="id_del_div"style="font-size: 10px"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
                  </div>
          
          
          
                  <div class="form-group col-md-2 col-lg-push" id="none">
                    <label class="">* Impuesto DEBE </label>
                    <div class='input-group input-group-sm '>
          
                      <select name="selectiomimuesto0" data-id="0" id="selectiomimuesto0" class="form-control noneIva" data-id="0"  disabled style="width: 110px;">
                      </select>
                      <div class="input-group-btn">
          
                      </div>
                      <input    type ="hidden" id="ivaimput0" name="ivaimput0" class="form-control  ivaimput0 none debe" value=""  autofocus  disabled >
          
                    </div>
          
                  </div>
          
          
                  <div class="form-group col-md-1 text-center col-lg-push">
                    <label>Agregar</label>
                    <div class="input-group input-group-sm">
                      <span class="input-group-btn">
                        <button id="div_add_1" data-id="1" onclick="addNewButtonDebe(this)" class="btn btn-sm btn-info btn-flat" type="button" data-select2-open="single-prepend-text">
                          <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                      </span>
                    </div>
          
                    <span class ="AP text-red" id="id_del_div"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
                  </div>  
          
                </div>
          
          
          
            </div>
                    <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br></div> -->
            <div id="Contenedor"  class="panel panel-default cls-panel  col-md-12 contenHaber">
            <div id="div_" class="add_div">
                              <div class="form-group col-md-6">
                                <label class="titulocambia">* HABER </label>
                                <div class="input-group input-group-sm">
          
                                  <select id="PlandeCuenta0" required class="singlet_2 form-control PlandeCuenta" name="PlandeCuenta0" title="Seleccione un Plan de Cuenta" data-fila="selecthaber0">
                                     <option value="185" selected=""> Ventas de mercaderías gravadas por 10%</option>
                                  </select>
                                </div>
                                <span class ="PPP text-red" id="id_del_div"style="font-size: 10px"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
                              </div>
                              <div class="form-group col-md-2 ">
                                <label>* Monto Grav.</label>
                                <div class="input-group input-group-sm">
          
                                  <input  title="Monto"  type ="text" data-id="0" id="monto_haber0" name="monto_haber0" class="form-control  monto_haber0 monto limpiar"  autofocus onkeyup="jqueryhaber(this)"  >
                                  <input type="hidden" name="montohaber0" id="montohaber0" class="montohaber0 limpiar" value="">
                                </div>
          
                                <span class ="AP text-red" id="id_del_div"style="font-size: 10px"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
                              </div>
          
                              <div class="form-group col-md-2 col-lg-push"  id="none">
                                <label class="">* Impuesto HABER  </label>
                                <div class='input-group input-group-sm '>
          
                                  <select name="selecthaber0" id="selecthaber0" class="form-control noneIva " data-id="0"  onchange="jqueryhaber(this)" readonly style="width: 110px;">
                                    <option value="11">IVA 10 %</option>
                                    <option value="21">IVA 5 %</option>
                                    <option value="0">Excenta</option>
          
          
          
                                  </select>
                                  <div class="input-group-btn">
          
                                  </div>
                                  <input    type ="hidden" id="ivahaber0" name="ivahaber0" class="form-control  ivahaber0 none haber" value=""  autofocus  readonly >
                                </div>
          
                              </div>
          
                              <div class="form-group col-md-1 text-center col-lg-push">
                                <label>Agregar</label>
                                <div class="input-group input-group-sm">
                                  <span class="input-group-btn">
                                    <button id="div_add" data-id="1" onclick="addNewButtonHaber(this)"  class="btn btn-sm btn-info btn-flat" type="button" data-select2-open="single-prepend-text">
                                      <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                  </span>
                                </div>
          
                                <span class ="AP text-red" id="id_del_div"style="font-size: 10px"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
                              </div>  
          
                            </div>
          
                            <div id="div_1" class="add_div hidehaber" >
                              <div class="form-group col-md-6">
                                <div class="input-group input-group-sm">
          
                                  
                                <select id="PlandeCuenta1" required class="singlet_2 form-control PlandeCuenta" name="PlandeCuenta1" title="Seleccione un Plan de Cuenta" data-fila="selecthaber1">
                                    <option value="186" selected="">Ventas de mercaderías gravadas por 5%</option>
                                  </select>
                                </div>
                                <span class ="PPP text-red"  id="id_del_div"style="font-size: 10px"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
                              </div>
                              <div class="form-group col-md-2">
                                <div class="input-group input-group-sm">
                                  <input  title="Monto"  type ="text" data-id="1" id="monto_haber1" name="monto_haber1" class="form-control  monto_haber1 monto limpiar"  autofocus onkeyup="jqueryhaber(this)"  >
                                  <input type="hidden" name="montohaber1" id="montohaber1" class="montohaber1 limpiar" value="">
                                </div>
          
                                <span class ="AP text-red"  id="id_del_div"style="font-size: 10px"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
                              </div>
          
          
          
                              <div class="form-group col-md-2 col-lg-push" id="none">
                                <div class='input-group input-group-sm '>
          
                                <select name="selecthaber1" id="selecthaber1" class="form-control noneIva" data-id="1"  onchange="jqueryhaber(this)" readonly style="width: 110px;">
                                    <option value="11">IVA 10 %</option>
                                    <option selected value="21">IVA 5 %</option>
                                    <option value="0">Excenta</option>
          
                                  </select>
                                  <div class="input-group-btn">
          
                                  </div>
                                  <input    type ="hidden" id="ivahaber1" name="ivahaber1" class="form-control  ivahaber1 none haber" value=""  autofocus  readonly >
          
                                </div>
          
                              </div>
          
          
                              <div class="form-group col-md-1 text-center col-lg-push">
                              </div>  
          
                            </div>
          
                            <div id="div_2" class="add_div hidehaber">
                              <div class="form-group col-md-6">
                                <div class="input-group input-group-sm">
          
                                <select id="PlandeCuenta2" required class="singlet_2 form-control PlandeCuenta" name="PlandeCuenta2" title="Seleccione un Plan de Cuenta" data-fila="selecthaber2">
                                  <option value="336" selected="">Ventas de mercaderías exentas  del iva</option>
                                  </select>
                                </div>
                                <span class ="PPP text-red"  id="id_del_div"style="font-size: 10px"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
                              </div>
                              <div class="form-group col-md-2">
                                <div class="input-group input-group-sm">
                                <input  title="Monto"  type ="text" data-id="2" id="monto_haber2" name="monto_haber2" class="form-control  monto_haber2 monto limpiar"  autofocus onkeyup="jqueryhaber(this)"  >
                                  <input type="hidden" name="montohaber2" id="montohaber2" class="montohaber2 limpiar" value="">
                                </div>
          
                                <span class ="AP text-red"  id="id_del_div"style="font-size: 10px"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
                              </div>
          
          
          
                              <div class="form-group col-md-2 col-lg-push" id="none">
                                <div class='input-group input-group-sm '>
                                 
                                <select name="selecthaber2" id="selecthaber2" class="form-control noneIva" data-id="2"  onchange="jqueryhaber(this)" readonly style="width: 110px;">
                                    <option value="11">IVA 10 %</option>
                                    <option  value="21">IVA 5 %</option>
                                    <option selected value="0">Excenta</option>
          
                                  </select>
                                  <div class="input-group-btn">
          
                                  </div>
                                  <input    type ="hidden" id="ivahaber2" name="ivahaber2" class="form-control  ivahaber2 none haber" value=""  autofocus  readonly >
          
                                </div>
          
                              </div>
          
          
                              <div class="form-group col-md-1 text-center col-lg-push">
                              </div>  
          
                            </div>
          
          
          
          
              </div>
            </div>
          
            <div class="panel panel-default cls-panel  col-md-5 " id="Contenedor2">  
              <div class="form-group  col-sm-6 ol-sm-offset-0 " >
                 <span class="label label-default">Tipos de Comprobante</span> 
                <div class="input-group input-group-sm">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" >
                    <i class="fa fa-registered" aria-hidden="true"></i>
                    </button>
                  </span>
                  <select name="tipoDocumento" id="tipoDocumento" class="form-control select" required >
                      <option value=""></option>
                      <option value="102">BOLETA DE TRANSPORTE PÚBLICO DE PASAJEROS</option>
                      <option value="103">BOLETA DE VENTA</option>
                      <option value="105">BOLETOS DE LOTERÍAS, JUEGOS DE AZAR</option>
                      <option value="106">BOLETO O TICKET DE TRANSPORTE AÉREO</option>
                      <option value="108">ENTRADA A ESPECTÁCULOS PÚBLICOS</option>
                      <option selected value="109">FACTURA</option>
                      <option value="110">NOTA DE CRÉDITO</option>
                      <option value="111">NOTA DE DÉBITO</option>
                      <option value="112">TICKET MÁQUINA REGISTRADORA</option> 
          
                  </select>
                </div>
              </div>
                <div class="col-sm-6 ol-sm-offset-0">
                  <span class="label label-default">*Fecha </span>
                  <div class="form-group" >
                    <div class='input-group input-group-sm date ' id='date1'>
                          <div class="input-group-addon">
                          <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>
                      <input required type="text" class="form-control Mes"  id="Mes" name="Entrega" data-date-format="YYYY-MM-DD" autofocus required  />
                    </div>
                    <span class ="Mes text-red" id="id_del_div" style="font-size: 10px"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
                  </div>
                </div>  
          
                <div class="form-group  col-sm-6 ol-sm-offset-0 " >
                <span class="label label-default">Tipo de Identificación</span> 
                <div class='input-group input-group-sm'>
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" >
                  <i class="fa fa-registered" aria-hidden="true"></i>
                  </button>
                </span>
                  <select  class ="select form-control" name="tipoIdentificacion" id="tipoIdentificacion"  title="Seleciona"  placeholder="Selecciona" required>
                        <option value="11">RUC</option> 
                          <option value="12">CÉDULA DE IDENTIDAD</option> 
                          <option value="13">PASAPORTE</option> 
                          <option value="14">CÉDULA EXTRANJERO</option>
                          <option value="15">SIN NOMBRE</option>
                          <option value="16">DIPLOMÁTICO</option>
                          <option value="17">IDENTIFICACIÓN TRIBUTARIA</option>
                          <option value="18">CLIENTE DEL EXTERIOR</option>
          
                  </select>
                </div>
              </div>   
          
              <div class="form-group  col-sm-6 ol-sm-offset-0" >
                <span id="conproveedor" class="label label-default" >Número de Identificación </span>
                <div class="input-group input-group-sm">
          
                  <select  class ="form-control errordiv" name="selec_Proveedor" id="selec_Proveedor"  title="Seleciona Proveedor"  placeholder="Selecciona" required>
                      <option value="" selected></option>
                  </select>
                  <span class="input-group-btn">
                    <button id="PlandeCuenta" onclick="addclien('Proveedor');" class="btn btn-default disat" type="button" data-select2-open="single-prepend-text">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                  </span>
                </div>
                <span class ="PRO text-red" id="id_del_div"style="font-size: 10px"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
              </div>
          
          
          
              <div class="form-group  col-sm-6 ol-sm-offset-0 ">
                <span class="label label-default">* Condicion </span>
          
          
                <div class='input-group input-group-sm date ' id='date'>
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" >
                  <i class="fa fa-registered" aria-hidden="true"></i>
                  </button>
                </span>
          
                  <select  class ="select3 form-control" name="forma_pago" id="forma_pago"  title="Seleciona"  placeholder="Selecciona" required>
                    <option value="1">Contado</option>
                    <option value="2">Credito</option>
                  </select>
                </div>
              </div>
          
          
              <div class="form-group  col-sm-12 ol-sm-offset-0 "  style="display: none" id="contenCuotas">
                <span class="label label-default">* Cuotas</span>
                <div class="input-group input-group-sm">
          
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default date-set" data-toggle="tooltip" data-placement="top"  title="Comprobantes "><i class="fa fa-random" aria-hidden="true"></i></button>
          
                  </span>
                 <input type='text' class="form-control "  autofocus data-mask="000000" id="cantidadCuota" name="cantidadCuota"  value="0"/>
          
                </div>
                <span class ="CUO text-red"   style="font-size: 10px"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
              </div> 
          
          
               <div class="form-group  col-sm-6 ol-sm-offset-0 ">
                  <span class="label label-default">Moneda extranjera</span>
                  <div class='input-group input-group-sm date ' id='date'>
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" >
                      <i class="fa fa-registered" aria-hidden="true"></i>
                      </button>
                    </span>
                    <select  class ="selecinfinity form-control" name="moneda" id="moneda"  title="Seleciona"  placeholder="Selecciona" required autofocus>
                      <option  value="N">NO</option>
                      <option value="S">SI</option>
                    </select>
                  </div>
                </div>
          
          
                <div class="form-group  col-sm-6 ol-sm-offset-0 ">
                  <span class="label label-default">Número de Comprobante</span>
                  <div class="input-group input-group-sm">
          
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default date-set" data-toggle="tooltip" data-placement="top"  title="Comprobantes "><i class="fa fa-random" aria-hidden="true"></i></button>
          
                  </span>
                  <input required   type ="text" id="factura_compra" name="factura_compra" class="form-control limpiar"  autofocus   >
                </div>
                <span class ="COMP text-red"  id="id_del_div" style="font-size: 10px"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
              </div> 
          
          
              <div class="form-group  col-sm-6 ol-sm-offset-0 ">
                <span class="label label-default">Número Timbrado</span>
                <div class="input-group input-group-sm">
          
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default date-set" data-toggle="tooltip" data-placement="top"  title="Comprobantes "><i class="fa fa-random" aria-hidden="true"></i></button>
          
                  </span>
                  <input required   type ="text" id="timbrado" name="timbrado" class="form-control limpiar"  autofocus data-mask="00000000" max="99999999"  >
          
                </div>
                <span class ="TIM text-red"   style="font-size: 10px"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
              </div> 
          
          <!--     <div class="form-group  col-sm-12 ol-sm-offset-0 ">
                <span class="label label-success"> &nbsp;&nbsp;&nbsp; Virtual&nbsp;&nbsp;&nbsp;</span>
                <span class="label label-success">* Vencimiento</span>
                <div class="input-group input-group-sm">
                  <span class="input-group-btn">
                    <label class="container_">
                    <input type="checkbox" name="checkbox_vence" id="checkbox_vence"  class="limpiar">
                    <input type="hidden" name="virtual" id="virtual" value="0" class="limpiar"> 
                    <span class="checkmark"></span>
                    </label>
                  </span>
                  <input  type ="text" id="vence" name="vence" class="form-control "  autofocus class="limpiar" >
          
                </div>
                <span class ="VEN text-red"  style="font-size: 10px" ></span>  
              </div>  -->
              <div class="col-sm-12 ol-sm-offset-0 ">
                              <div class="box-footer">
                                <div class="row text-center">
                                  <div class="col-sm-4 border-right ">
                                    <div class="description-block" id="inputaUno" style="display: none">
                                      <h5 class="description-header formonto" id="box-monto">IMPUTA AL IVA</h5>
                                        <input type="hidden" name="inputaUno"  class="control" value="N">
                                        <input type="checkbox" class="chech" value="0" name="inputaUno" data-off-icon-cls="fa-thumbs-o-down" data-on-icon-cls="fa-thumbs-o-up">                               
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4 border-right ">
                                    <div class="description-block" id="inputaDos" style="display: none">
                                      <h5 class="description-header formonto" id="box-pagos">IMPUTA AL IRE</h5>
                                         
                                      <input type="hidden" name="inputaDos"  class="control" value="N">
                                          <input type="checkbox" class="chech" value="0" name="inputaDos" data-off-icon-cls="fa-thumbs-down" data-on-icon-cls="fa-thumbs-up"> 
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-4 border-right " id="inputaTres" style="display: none">
                                    <div class="description-block ">
                                      <h5 class="description-header formonto" id="box-saldo">IMPUTA AL IRP-RSP</h5>
          
                                      <input type="hidden" name="inputaTres"  class="control" value="N">
                                          <input type="checkbox" class="chech" value="0" name="inputaTres" data-off-icon-cls="fa-thumbs-o-down" data-on-icon-cls="fa-thumbs-o-up">                               
          
          
          
                                    </div>
                                    <!-- /.description-block -->
                                  </div>
                                </div>
                              </div>
              </div>
          
          
          
          
          
            </div>
            
            </div>
          
          
            <hr>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bg-danger " id='bloque1'  >
          
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bg-navy  " >
                <span>Total Asiento  Debe:   </span><span id=""> </span>
                <input type="hidden" id="input_totaldebe" name="input_debe" class="limpiar" value="">
                <input type="text" id="totaldebe"  class="limpiar" disabled style="font-weight: bold; color: crimson">
              </div>  
          
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bg-navy  " >
                <span>Total Asiento  Haber:   </span><span id=""> </span>
                <input type="hidden" id="input_totalhaber" name="input_haber" class="limpiar" value="">
                <input type="text" id="totalhaber" class="limpiar" disabled style="font-weight: bold; color: crimson">
              </div> 
          
              <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 bg-navy  " >
                <span>Diferencia:   </span>
                <input type="text" id="input_Diferencia" class="limpiar" disabled style="font-weight: bold; color: crimson">
              </div> 
          
              </div>                                     
          
          
            <div class="panel panel-default cls-panel   col-sm-12 bg-gray-active "  id='bloque2'>
              <br>
              <div class="form-group col-sm-6 .ol-sm-offset-0">
          
                <div class="input-group input-group-sm">
                  <div class="input-group-addon">
                    <i class="fa fa-comments-o" aria-hidden="true"> Observaciones</i>
                  </div>
                  <textarea  name="observaciones" id="textarea" class="form-control " rows="3" maxlength="150"></textarea >
                </div>
                <span class ="AP text-red"  id="id_del_div"></span>   <!--    INDICADORES DE ERROR A TRAVEZ DE AJAX -->
              </div>
              <div class="col-sm-2 col-sm-offset-0 col-md-2 col-md-offset-0">
                <button type="submit" id="loadingg" name="add_add" class="btn btn-sm btn-success btn-block" data-loadingg-text="Procesando Unos Segundos..." autocomplete="off">
                  <span class  ="glyphicon glyphicon-floppy-disk" id="btnSave"  >Guardar</span> 
                </button>
          
              </div>   
           
                <div class="col-sm-2 col-sm-offset-0 col-md-2 col-md-offset-0">
                  <button type ="button" class="btn btn-sm btn-danger btn-block" data-toggle="collapse" onclick="resetear()" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" >
                    <span class  ="glyphicon glyphicon-floppy-remove"></span> Cancelar</button>     
                  </div>               
                </div>
              </div>
          
          
            </div><!-- /.box -->
          
          </div>
          
          
          </div>
        
          <script type="text/javascript" src="miscript.js">
          <script type="text/javascript">
          
          
          $(function() {
              $(':checkbox').checkboxpicker();
          $('#factura_compra').mask('000-000-0000000',options);
          $('#timbrado').mask('00000000', {reverse: true});
          $('#monto0,#ivaimput0,.des_obtenido0,.monto,#m_onto0,#excenta,.monto_haber0').mask('000.000.000.000.000', {reverse: true});    //123456  =>  
            $( ".select" ).select2( {
               allowClear: true,
              placeholder: 'Busca y Selecciona',
              width: null,
              theme: "bootstrap"
            } );
          $(".singlet_2").select2(ajaxsinglet()).change(function(event) {
            if ($(this).val()) {
              selectinpuesto( $(this) )
            }
          });
          
          $("#selec_Proveedor").select2(ajacReloadPro());
          
          $('#selec_Proveedor').change(function(event) {
            if ($(this).val() == 1668) {
              $('#tipoIdentificacion').val(15).change();
            } 
          });
          
          $('#factura_compra').click(function(event) {
          $(this).val('0');
          });
          
          $('#vence').datetimepicker({
          format: 'YYYY-MM-DD',
          });
          
          $('#forma_pago').change(function(event) {
          if ($(this).val() == '2') {
          $('#condicion').val('2');
          $('#contenCuotas').show();
          $('#cantidadCuota').prop('required', true);
          }else{
          $('#condicion').val('1');
          $('#contenCuotas').hide('fast');
          $('#cantidadCuota').prop('required', false);
          }
          });
          
          $(".select3").select2({
          tags: "true",
          theme: "bootstrap",
          allowClear: true,
          // placeholder: 'Busca y Selecciona',
          width: null
          
          
          });
          
          $('input').on('ifUnchecked', function(event){
          $('#IVA5,#Iva10').removeAttr('disabled');
          $(this).val('');
          });
          
          /**
          * [Contro checkbox para activar o desactivar venciminero boleta o si es virtual o no]
          * @param 
          * @return [description]
          */
          $('#checkbox_vence').change(function(event) {
          if ($(this).is(':checked')) {
          $('#virtual').val(1);
          $('#vence').prop({disabled: true}).val("");
          }else{
          $('#virtual').val(0);
          $('#vence').prop({disabled: false});
          }
          });
          
          // $("input").focus(function(){
          // $('span#id_del_div').hide('fast');
          // $(this).removeClass('errordiv');
          // })
          
          $('#selec_Proveedor').change(function (e) { 
          $('#factura_compra').val('');
          
          if ($(this).val() == '192') {
          $('#factura_compra').val('000-000-0000000');
          $('#timbrado').val('00000000');
          
          }
          
          e.preventDefault();
          
          });
                       $('#Mes').datetimepicker({
                             viewMode: 'years',
                             format: 'YYYY-MM-DD',
                      }).on("dp.change", function (e) {
          
                          $min = new Date(periodo+"-01-01");
                          $max = new Date(periodo+"-12-31");
                         
                          $('#Mes').data("DateTimePicker").minDate($min);
                          $('#Mes').data("DateTimePicker").maxDate($max);
                          if ( $("#vence").length ) {
                            $('#vence').data("DateTimePicker").minDate($min);
                          }
                          
          
                          $(this).removeClass('errordiv');
                          $('span#id_del_div').hide('fast');
          
                          let fe = $(this).val().substring(5,7);
                          $('#buscaprfecha').val(fe);
                    
          
                      });
          
                      let inputauno = $('#Empresa').find(':selected').data('uno');
                      let inputados = $('#Empresa').find(':selected').data('dos');
                      let inputatres = $('#Empresa').find(':selected').data('tres');
                      if (inputauno == 1) {
                        $('#inputaUno').show('fast');
          
                      }else{
                        $('#inputaUno').hide('fast');
          
                      }
                      if (inputados == 1) {
                        $('#inputaDos').show('fast');
                        
                      }else{
                        $('#inputaDos').hide('fast');
          
                      }
                      if (inputatres == 1) {
                        $('#inputaTres').show('fast');
                        
                      }else{
                        $('#inputaTres').hide('fast');
          
                      }
          
           $(':checkbox').checkboxpicker().on('change', function() {
          
                 $(this).is(':checked') ? $(this).val('S') : $(this).val('N');
          
          
            });
          
            $('#tipoIdentificacion').change(function(event) { // selec_Proveedor
                var val = $(this).val();
                  $('#selec_Proveedor').attr('onkeypress',false).html('');
                $('.cpf').mask('0000000########-0', {reverse: true});
              switch(true) {
                case val == 12 || val == 13 || val == 14 || val == 16 || val == 17:
                  $('.cpf').mask('0000000########0', {reverse: true});
                break;
                case val == 15:
                       $('#selec_Proveedor').attr('onkeypress',true).html('<option value="1668">SIN NOMBRE</option>');
          
                break;
                case val == 18:
                      $('#selec_Proveedor').attr('onkeypress',true).html('<option value="1669">CLIENTE DEL EXTERIOR</option>');
                break;    
              }
          
          
            });
          
          
            $('#tipoDocumento').change(function (e) { 
              e.preventDefault();
              $('.contenAsociado').hide('fast');
              $('.clasAsociado').attr('required',false);
              $('#timbrado').attr('disabled',false);
              $('#factura_compra').val('').mask('000-000-0000000', {reverse: true});
              var val = $(this).val();
          
              switch(true) {
                case val == 112 || val == 106 || val == 107:
                  // Requerido, a excepción de los tipos de
                  // comprobantes 112 (TICKET MÁQUINA
                  // REGISTRADORA), 106 (BOLETO O TICKET DE
                  // TRANSPORTE AÉREO) o 107 (DESPACHO DE
                  // IMPORTACIÓN).
                  // • Formato ###-###-#######.
                    if (val == 107) {
                    $('#timbrado').attr('disabled',true);
          
                    }
                    if (val == 112) {
                    $('#factura_compra').mask('00000##############', {reverse: true});
          
                    }
          
                  break;
                  case val == 112 || val == 101 || val == 104 || val == 105:
                    // • El valor debe ser igual a la suma de los campos
                    // MONTO GRAVADO AL 10% (IVA INCLUIDO),
                    // MONTO GRAVADO AL 5% (IVA INCLUIDO) y
                    // MONTO NO GRAVADO O EXENTO, a
                    // excepción de los tipos de comprobantes 101
                    // (AUTOFACTURA), 112 (TICKET MÁQUINA
                    // REGISTRADORA), 104 (BOLETA RESIMPLE) y
                    // 105 (BOLETOS DE LOTERÍAS, JUEGOS DE
                    // AZAR) para los cuales solo se registra el
                    // campo MONTO TOTAL DEL COMPROBANTE
                    
          
          
                  break;
          
                  case val == 110 || val == 111:
                    $('.contenAsociado').show('fast');
                    $('.clasAsociado').attr('required',true);
          
          
                  break;
          
              }
          
              
            });
          
          
              $('#forma_pago').change(function (e) {
             
                let conten;
                switch (control) {
                  case '1':
                  conten ='PlandeCuenta0' ; //compras
                    break;
                  case '2':
                   conten ='pagosde0' ;// ventas
                    break;
                }
              
              if ($(this).val() == 1) { 
                // si es contado
                     $('#'+conten).html('').append(new Option('Caja ', '5', true, true)).trigger("change");
              }else{
                     $('#'+conten).html('').append(new Option('Proveedores locales ', '114', true, true)).trigger("change");
              }
              e.preventDefault();
            });
            
          
          });
          
          </script>