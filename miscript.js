var maxDiv = 9, nextinput = 0 ,maxDiv2 = 9, nextinput2 = 2,nextinput3 = 0,dataid = '',control = 1,argumento ='',requere,val,maxdate,mindate,defdate;
var addform = 'addaciento';
var myempresa,de_be,haber,none,fecha01 ,fecha02,Item_add,estadoApertura,idestadoApertura,AliasCloseOpen,periodo= '';
  const inputOptions = new Promise((resolve) => {
    setTimeout(() => {

    }, 3000)
  })
  const formatR = (repo) => {
    
    if (repo.loading) return repo.text;
    var markup =
    "<div class='select2-result-repository clearfix' id='"+repo.code+"' data-name='"+repo.full_name+"'>" +
        "<div class='select2-result-title'> "+ repo.code+' '+repo.full_name + "</div>"+
      "</div>";

    return markup;
  }

  const formatRepoSelect = (repo) => {
    return  repo.full_name || repo.text;
  }

 const ajaxsinglet = () => {
      return {
              ajax: {
                url: "select2remote",
                dataType: 'json',
                delay: 250,
                cache: false,
                data: function (params) {
                  return {
                    q: params.term, // search term
                    page: params.page,
                  };
                },
                processResults: function (data, params) {
                  params.page = params.page || 1;

                  return {
                    results: data.items,
                    pagination: {
                      more: (params.page * 30) < data.total_count
                    }
                  };
                },
              },
              escapeMarkup: function (markup) { return markup; },
              minimumInputLength:2,
              templateResult: formatR,
              templateSelection: formatRepoSelect,
              theme: "bootstrap",
                allowClear: true,
                placeholder: 'Busca y Selecciona',
                width: null
            }
 }

  const ajacReloadPro = () =>{
    return{
      ajax: {
        url: "AcientoEdit/remote",
        dataType: 'json',
        delay: 250,
        cache: false,
        data: function (params) {
          return {
            q: params.term, // search term
            page: params.page,
          };
        },
        processResults: function (data, params) {
          params.page = params.page || 1;
    
          return {
            results: data.items,
            pagination: {
              more: (params.page * 30) < data.total_count
            }
          };
        },
      },
      escapeMarkup: function (markup) { return markup; },
      minimumInputLength:2,
      templateResult: formatRes,
      templateSelection: formatRepo,
      theme: "bootstrap",
        allowClear: true,
        placeholder: 'Busca y Selecciona',
        width: null
    }
  }


  const selectinpuesto =  (event)=>{
     let fila = event.data('fila');

     if ($('[name="'+fila+'"]').is(':disabled') == false) {

     let ca = event.attr('id');
     let txt = $('span #select2-'+ca+'-container').text();

        switch(true) {
          case txt.indexOf('10') !== -1:

            $('[name="'+fila+'"]').val(11).change();

            break;
          case txt.indexOf('5') !== -1:

            $('[name="'+fila+'"]').val(21).change();
            
            break;
          default :
             // $('[name="'+fila+'"]').val(0).change();
              break;
        }

     }
  }

  const formatRepo =  (repo) =>{

    return repo.ruc || repo.text;
  }

  const formatRes =  (repo) =>{
    
    if (repo.loading) return repo.text;
    var markup =
    "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository'>" +
        "<div class='select2-result-title'>" + repo.full_name + "</div>"+
        "<div class='select2-result-description'>RUC: " + repo.ruc + "</div>"+
      "</div>" +
      "</div></div>";

    return markup;
  }
  const greet = x => {
    Swal.fire({
     title: 'Cargando...',
     showConfirmButton: false,
     input: 'radio',
     inputOptions: inputOptions,
     timer: x
   });
}

  const req =  (arguments) =>{
    $(arguments).attr('required', 'required');
  }
  const remo =  (arguments) =>{
    $(arguments).removeAttr('required');
  }


/////////////////////////////////////////////////////
 var options =  {
  onKeyPress: function(cep, e, field, options) {
    var masks = ['000-000-0000000', '000',cep];
    var mask =  masks[0];
    switch (true) {
      case cep.length == 3:
        if (cep != 000){
          mask =  masks[0];
        }else{
          mask =  masks[1];
          toastem.error('<span style="font-size:14px;color:#EA4335">El Valor no puede ser 000.</span>');

        }
        break;
    
      case cep.length == 7:
        if(cep.substring(4,7) != 000){
          mask =  masks[0];
        }else{
          mask =  masks[2];
          toastem.error('<span style="font-size:14px;color:#EA4335">El Valor no puede ser ###-000.</span>');

        }
        break;
    }

    // var mask = (cep.length == 3) ? masks[1] : masks[0];
    $('#factura_compra').mask(mask, options);
}};

// $(".Declaraciones").select2({
//   minimumResultsForSearch: Infinity
// });

$(function() {
    $( ".Aciento,.add,.addAciento" ).addClass( "active" );
    $( "#add_aciento" ).addClass( "text-red" );
     $('#factura_compra').mask('000-000-0000000',options);


    var placeholder = "&#xf002 Selecciona ";  
    $( ".select,.Declaraciones" ).select2( {
      allowClear: true,
      placeholder: placeholder,
      width: null,
      theme: "bootstrap",
    //   minimumResultsForSearch: Infinity,
        escapeMarkup: function(m) { 
           return m; 
        }

    } );


    
    $(document).on('focus','.monto' , function() {
      var value = formatNumber.new($('#input_Diferencia').val());
      if(value != 0){
          let val1 = $('#input_totaldebe').val();
          let val2 = $('#input_totalhaber').val();
          let abue =  $(this).parent().parent().parent().parent().hasClass('contenDebe');
          let abue2 =  $(this).parent().parent().parent().parent().hasClass('contenHaber');

          if(abue == true && val1 < val2){ 
              $(this).val(value.replace(',','.')).trigger('keyup').change();

          }
          // haber
          if(abue2 == true && val2 < val1){ 
              $(this).val(value.replace(',','.')).trigger('keyup').change();
          }
      
        }

    });

    
    $(document).on('focus','input',function(){
      $('span#id_del_div').hide('fast');
      $(this).removeClass('errordiv');
    });


 
    $('.Declaraciones').change(function(event) {
      
      val =  $(this).val();
        $('#tabsName').appendTo('');
     if (estadoApertura != 1){
 
       $('.close02,.tapclouse').html('').hide("fast");

       de_be = haber = none = $hid  = '';
       $('div.add_div_new').remove();
       $('#Mes').attr('required',true);
       
     switch(val) {
       // VISTA libro compra
       case '1':
         var data = {id: val};
         nextinput2 = 3,nextinput = 1;
         greet(500);
         $('#tapclouse').load('loadData',data,function(responseTxt, statusTxt, jqXHR) {
           if(statusTxt == "success"){
             $('#cantidad_haber').val(0);
             $('#cantidad_debe').val(2);
             addform = 'addaciento';
             requere = 'required';
             haber = 'disabled';
             control = val;
             methodCuenta ('0','11','selectiomimuesto0');
               $('.tapclouse').show('slow');
               $('.nav-tabs a[href="#tab_2"]').tab('show');
               $('#tabsName').text('Compras');

         }

       });

         break;
         //vista libro ventas
       case '2':
         var data = {id: val};
         nextinput2 = 1,nextinput = 3;
           greet(500);
           $('#tapclouse').load('loadData',data,function(responseTxt, statusTxt, jqXHR) {
           if(statusTxt == "success"){
               addform = 'addaciento';
               requere = 'required';
               de_be   = 'disabled';
               control = val;
             methodCuenta ('0','11','selecthaber0');
               $('.tapclouse').show('slow');
               $('.nav-tabs a[href="#tab_2"]').tab('show');
              $('#tabsName').text('Ventas');
              $.ajax({
                url: 'getTimbrado',
                type: 'POST',
                data: {id: myempresa,table:$('#Empresa').val()+'_acientos',where:'Declaraciones_idDeclaraciones',ident:'idAcientos'},
              })
              .done(function(data) {
                $('[name="timbrado"]').val(data);
              });
         }

       });

         break;

       case '3':
             var data = {id: val};
             nextinput2 = 1,nextinput = 3;
           greet(500);
           $('#tapclouse').load('loadData',data,function(responseTxt, statusTxt, jqXHR) {
               if(statusTxt == "success"){
                 addform = 'addnull';
                 requere = '';
                 de_be = 'disabled';
           
                 control = val;
                   $('#tabsName').text('   Facturas Anuladas');
                   $('.tapclouse').show('slow');
                   $('.nav-tabs a[href="#tab_2"]').tab('show');
   
             }
   
           });  
         break;
       case '4':
           var data = {id: val};
           nextinput2 = 1,nextinput = 1;
           greet(500);
           $('#tapclouse').load('loadData',data,function(responseTxt, statusTxt, jqXHR) {
             if(statusTxt == "success"){
               addform = 'addinventario';
               requere = 'required';
               none = '';
         
               control = val;
                 $('#tabsName').text('   Asiento  Manual');

                 $('.tapclouse').show('slow');
                 $('.nav-tabs a[href="#tab_2"]').tab('show');
 
           }
 
         });
         break;
         case '5':
               $('#Mes').attr('required',false);
               $('.close01,#bloque1,#bloque2').hide('fast'); 
               var data = {Periodo: $('#Periodo').val(),Empresa: $('#Empresa').val()};
               greet(800);
                 $('#close02').load('loadDataA',data,function(responseTxt, statusTxt, jqXHR) {
                     if(statusTxt == "success"){

                         $('.tapclouse,.close02').show('slow');
                         $('.nav-tabs a[href="#tab_2"]').tab('show');
                         $('#tabsName').text('Asiento  de Cierre y Apertura');

                   }

                 });




         break;
         case '6':
               $('#Mes').attr('required',false);
              greet(800);
               var data = {id: val};

                 $('#tapclouse').load('loadData',data,function(responseTxt, statusTxt, jqXHR) {
                     if(statusTxt == "success"){

                         $('.tapclouse').show('slow');
                         $('.nav-tabs a[href="#tab_2"]').tab('show');
                         $('#tabsName').text('Subir Archivos');
                         

                   }

                 });
        break;
       case '7':
         var data = {id: val};

         greet(500);
         nextinput2 = 3,nextinput = 1;

 
         $('#tapclouse').load('loadData',data,function(responseTxt, statusTxt, jqXHR) {
           if(statusTxt == "success"){
             addform = 'addRecibos';
             control = val;
               $('.tapclouse').show('slow');
               methodCuenta ('0','11','selectiomimuesto0');
               $('.nav-tabs a[href="#tab_2"]').tab('show');
                         $('#tabsName').text('   Recibo de Cobro');

         }

       });
         break;
       case '8':
         var data = {id: val};
         nextinput2 = nextinput = 1;
           greet(500);
 
           $('#tapclouse').load('loadData',data,function(responseTxt, statusTxt, jqXHR) {
             if(statusTxt == "success"){
                 addform = 'addRecibos';
                 control = val;
                 $('.tapclouse').show('slow');
                 $('.nav-tabs a[href="#tab_2"]').tab('show');
                         $('#tabsName').text('   Recibo de Pagos');

           }

         });

         break;
       case '9':
         var data = {id: val};
         nextinput2 = 1 ; nextinput = 3;
           greet(500);
 
           $('#tapclouse').load('loadData',data,function(responseTxt, statusTxt, jqXHR) {
             if(statusTxt == "success"){
                 addform = 'addNotaCredito';
                 control = val;
                 $('.tapclouse').show('slow');
                 $('.nav-tabs a[href="#tab_2"]').tab('show');
                         $('#tabsName').text('  Notas de Crédito - Compras');

           }

         });

         break;
       case '10':
         var data = {id: val};
         nextinput2 = nextinput = 1;
           greet(500);
 
           $('#tapclouse').load('loadData',data,function(responseTxt, statusTxt, jqXHR) {
             if(statusTxt == "success"){
                 addform = 'addNotaCredito';
                 control = val;
                 $('.tapclouse').show('slow');
                 $('.nav-tabs a[href="#tab_2"]').tab('show');
                         $('#tabsName').text('  Notas de Crédito - Ventas');

           }

         });

         break;
       case '11':
         var data = {id: val};
         nextinput2 = nextinput = 1;
           greet(500);
 
           $('#tapclouse').load('loadData',data,function(responseTxt, statusTxt, jqXHR) {
             if(statusTxt == "success"){
                 addform = 'addNotadevito';
                 control = val;
                 $('.nav-tabs a[href="#tab_2"]').tab('show');
                 $('.tapclouse').show('slow');
                         $('#tabsName').text('  Notas de Débito - Ventas');

           }

         });

         break;

      default:
        $('.tapclouse,.close02').hide("slow");
       break;

     }
    // toastem.success(val);
     control = val;
   }else{ 
     if($(this).val() > 0){ 
       Swal.fire({
         title: "Ya se realizo el Cierre del Periodo Seleccionado",
         text: "Abrir CIERRE Y APERTURA",
         type: "error",
         showCancelButton: true,
         confirmButtonText: "Editar Periodo",
         cancelButtonText: "Cancelar Modificacion",
         confirmButtonColor: "#DD6B55",
         showCancelButton: true,
         closeOnConfirm: false

       }).then((result) => {
         if (result.value) {
             Swal.fire({
               title: 'Solicitando Edicion de datos',
               showConfirmButton: false,
               input: 'radio',
               inputOptions: inputOptions,
               timer: 3000
             });
               $.post( "confirmEditCierre", { idAper: idestadoApertura, AliasClose:AliasCloseOpen,idEmpre: $('#Empresa').val() } )
               .done(function( data ) {
                 setTimeout(() => {
                   if (data) {
                     Swal.fire('Cierre y Reapertura ', 'Abierta');
                     estadoApertura = 0;
                     $('.Declaraciones').change();
                  }
                 }, 3000);

               });
         } else if (result.isDenied) {
           Swal.fire('Changes are not saved', '', 'error')
         }
       })

         
    


     }
     
   }



   });


    $('#reset').on('click', function(e) {

       $('.selec_ limpiar,#factura_compra,input').val('');
       $('.PlandeCuenta').val('').change();
       $("#totaldebe,#totalhaber").val('');
          if (addform == 'addaciento') {
            $('.haber,.debe').val('');
          }

          if (addform == 'addnull') {
              $("input:not(#buscaprfecha,#factura_compra,#Mes,#ivahaber0)").removeAttr('required');
          }
    });





  $('#from_aciento').submit(function(e){
    if ($('#input_totaldebe').val() != $('#input_totalhaber').val()) {
      Swal.fire('Los Montos de Haber y Debe No Coinsiden!!');
      return false;
    }
    $bandera = false;
    $(':checkbox').checkboxpicker().each(function() {
      // console.log("Checkbox " + $(this).prop("name") +  " (" + $(this).val() + ") Seleccionado");
        if ($(this).val() == 'S') { 
            $bandera = true;
            return false;
        }else{ 
            $bandera = false;
        }
 



    });
      if (control == '7' || control == '8' ||  control == '3' || control == '4' || control == '5' || control == '6'){
        $bandera = true;
      }    
    
    if ($bandera == false) {
      Swal.fire('Campos Imputa is Requerido.!!');
      return false;
    }
       $('.desc,.PRO,.COMP,.PR,.FINAL,.TIPO,.FECHA,.INIT,.COND,.CUO,.FLE,.OBSER,#list_acientos_aler,.TIM,.VEN').html("").css({"display":"none"});
       $('input').removeClass('errordiv');
       let timbrado = $('#timbrado').val();

          $b = $('#loadingg');
          var ajaxTime= new Date().getTime(); 
                     $.ajax({
                        url: addform,
                        type : 'POST',
                        cache: false,
                        data: $(this).serialize(), // serilizo el formulario
                        beforeSend: function(){
                          $('#loadingg').attr("disabled","disabled");
                          $b.button("loadingg");
                          },
                      })
                      .done(function(data) {
                        var json = JSON.parse(data);// parseo la dada devuelta por json
                        if (json.res == 'error') {
                                                  $b.button("reset");
                                                  $('#loadingg').removeAttr('disabled');
                                           if (json.selec_Proveedor) {
                                                   $(".PRO").html(json.selec_Proveedor).show(); // mostrar validation de iten
                                                }
                                                 if (json.comprobante) {
                                                   $(".COMP").html(json.comprobante).show(); // mostrar validation de iten
                                                }
                                                 if (json.orden) {
                                                   $(".PR").html(json.orden).show(); // mostrar validation de iten
                                                }
                                                if (json.montofinal) {
                                                   $(".FINAL").html(json.montofinal).show(); // mostrar validation de iten
                                                   $(".FINAL").fadeOut(5000); 
                                                }
                                                 if (json.tipoComprovante) {
                                                   $(".TIPO").html(json.tipoComprovante).show(); // mostrar validation de iten
                                                }
                                                 if (json.fecha) {
                                                   $(".FECHA").html(json.fecha).show(); // mostrar validation de iten
                                                }
                                                if (json.inicial) {
                                                   $(".INIT").html(json.inicial).show(); // mostrar validation de iten
                                                }
                                                 if (json.condicion) {
                                                   $(".COND").html(json.condicion).show(); // mostrar validation de iten
                                                }
                                                 if (json.cuotas) {
                                                   $(".CUO").html(json.cuotas).show(); // mostrar validation de iten
                                                }
                                                 if (json.fletes) {
                                                   $(".FLE").html(json.fletes).show(); // mostrar validation de iten
                                                }
                                                if (json.descuento) {
                                                   $(".desc").html(json.descuento).show(); // mostrar validation de iten
                                                }
                                                 if (json.observaciones) {
                                                   $(".OBSER").html(json.observaciones).show(); // mostrar validation de iten
                                                }
                                                if (json.timbrado) {
                                                   $(".TIM").html(json.timbrado).show(); // mostrar validation de iten
                                                }
                                                 if (json.vence) {
                                                   $(".VEN").html(json.vence).show(); // mostrar validation de iten
                                                }
                                                if (json.comprobante) {
                                                  $('#factura_compra').addClass('errordiv');
                                                    $(".COMP").html(json.comprobante).show();
                                                }    
                                                if (json.Mes) {
                                                  $('input#Mes').addClass('errordiv').val('').change();
                                                    $(".Mes").html(json.Mes).show();
                                                }
                                                  if (json.money0) {
                                                       // $('input#Mes').addClass('errordiv').val('').change();
                                                        $("#errormoney0").html(json.money0).show();
                                                   }
                                                     if (json.money1) {
                                                       // $('input#Mes').addClass('errordiv').val('').change();
                                                        $("#errormoney1").html(json.money1).show();
                                                   }

                                                  if (json.monto_haber0) {
                                                       // $('input#Mes').addClass('errordiv').val('').change();
                                                        $("#errormonto_haber0").html(json.monto_haber0).show();
                                                   }
                                                  if (json.monto_haber1) {
                                                       // $('input#Mes').addClass('errordiv').val('').change();
                                                        $("#errormonto_haber1").html(json.monto_haber1).show();
                                                   }


                        }else{
                                            //   $("#Periodo,.none,.debe,.haber,#Mes").change();
                                            var totalTime = new Date().getTime()-ajaxTime; 
                                              toastem.complete('<span class="fa fa-fw fa-bell-o"></span> <span data-notify="title">Datos Registrado Correctamente Duracion '+totalTime+' milisegundo </span> ');  
                                            setTimeout(function() {
                                              
                                              $('.limpiar,input.none,input.Mes,.selec_').val('');

                                              $("div.add_div_new").remove();
                                      

                                              $('#forma_pago').val('1').change();

                                        
                                              $('input.debe,input.haber').removeAttr('required');



                                              switch (control) {
                                                case '1':
                                                $("#selec_Proveedor").val('').change();
                                                  nextinput2 = 3;
                                                  nextinput = 1;
                                                  $('#cantidad_haber').val(0);
                                                  $('#cantidad_debe').val(2);
                                              $(':checkbox').checkboxpicker().each(function() {
                                                  $(this).prop('checked', false);
                                              });

                                                  
                                                break;
                                                case '2':
                                                    // $("#tipoIdentificacion").val('').change();
                                               
                                                    if ($("#tipoIdentificacion").val() != 15 ) {
                                                        $("#selec_Proveedor").val('').change();
                                                       
                                                    }
                                                
                                                  nextinput2 = 1;
                                                  nextinput = 3;
                                                  $('#cantidad_haber').val(2);
                                                  $('#cantidad_debe').val(0);
                                                  $('#timbrado').val(timbrado);
                                                break;
                                                case '3':
                                                $("#selec_Proveedor").val('').change();
                                                  $("#ivahaber0").removeAttr('required').val(0);
                                                  break;
                                                case '4':
                                                  nextinput2 = 1;
                                                  nextinput = 1;
                                                  $("#selec_Proveedor").val('').change();
                                                  $(".singlet_2 ").val('').change();
                                                  $('#cantidad_haber').val(0);
                                                  $('#cantidad_debe').val(0);
                                                break;
                                                case '7':
                                                  nextinput2 = 1;
                                                  nextinput = 1;
                                                  $("#selec_Proveedor").val('').change();
                                                  $('#cantidad_haber').val(0);
                                                  $('#cantidad_debe').val(0);
                                                  $('.formonto').text(0);


                                                break;
                                              case '8':
                                                  nextinput2 = 1;
                                                  nextinput = 1;
                                                  $("#selec_Proveedor").val('').change();
                                                  $('#cantidad_haber').val(0);
                                                  $('#cantidad_debe').val(0);
                                                  $('.formonto').text(0);

                                                break;

                                              }
                               


                                            },100);
                        }
                      })
                      .fail(function() {
                        $b.button("reset");
                        $('#loadingg').removeAttr('disabled');
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Algo salió mal!',
                          footer: '<a href="">Los Datos no se han podido Registrar</a>'
                        })
                      })
                      .always(function() {
                        $b.button("reset");
                        $('#loadingg').removeAttr('disabled');

                      });
    e.preventDefault();
  });


      $('#Periodo').datetimepicker({
         format: 'YYYY',
  
      }).on("dp.change", function (event) {
        $('.showHideDeclaDATE').val('').change().attr("disabled",false);
        periodo = $(this).val();
   
          if ($(this).val()) {
          
           $.post( "getCierreEstatu", { date: $(this).val(), id: $('#Empresa').val() } )
           .done(function( data ) {
             let json = JSON.parse(data);
             if (json) {
              estadoApertura = json.Estado;
              idestadoApertura = json.idAperturaCierre;
              AliasCloseOpen = json.AliasCloseOpen;   
             }
  

           });

           
            setTimeout(() => {
                $('.showHideDeclaDATE').attr("disabled",false).select2('open');
            }, 1800);
          }else{
            $('.showHideDeclaDATE').attr("disabled",true);
            $('div#Mes').remove(); 
            $('div#date1').html('<input  type="text" class="form-control"  id="remv"  autofocus disabled />'); 
          }


    });





  $('#Empresa').change(function(event) {
    $("#Periodo,.showHideDeclaDATE").val('').change();
    

    if ($(this).val() > 0) {
       myempresa = $(this).val();

      $('.disat').removeAttr('disabled').val('');

    }else{
      $('.disat').attr('disabled', 'disabled');

    }
    $('input#userdata').val($(this).val());




    
  });


}); 
/**
 * [remove2 remover debe]
 * @param  {[type]} val [description]
 * @return {[type]}     [description]
 */
function remove(val){
    var des        = $('#cantidad_haber').val();
    var money;
    var finalmoney = 0;
    $( "#div_"+des ).remove();
    nextinput --;
    $('#cantidad_haber').val(nextinput-1);
    for (var i = 0; i < nextinput; i++) {
      money = sanearnum($('#monto_haber'+i).val());
      if (money > 0) {
        finalmoney+=parseFloat(money);
      }
    }
    $('#totalhaber').val(formatNumber.new(finalmoney));
    $('#input_totalhaber').val(finalmoney);
    difnca();

}
/**
 * [remove2 remover debe]
 * @param  {[type]} val [description]
 * @return {[type]}     [description]
 */
function remove2(val){
    var des        = $('#cantidad_debe').val();
    var money;
    var finalmoney = 0;
    $( "#2div_"+des).remove();
    nextinput2 --;
    $('#cantidad_debe').val(nextinput2-1);
    for (var i = 0; i < nextinput2; i++) {
      money = sanearnum($('#money'+i).val());
      if (money > 0) {
        finalmoney+=parseFloat(money);
      }
    }
         $('#totaldebe').val(formatNumber.new(finalmoney));
         $('#input_totaldebe').val(finalmoney);
         difnca();
}

function addNewButtonDebe (e) {
  if (nextinput2 < maxDiv2) {
  conten = '<div id="2div_'+nextinput2+'" class="add_div_new"><div class="form-group col-md-6"><div class="input-group input-group-sm">'+
  '<select id="pagosde'+nextinput2+'" '+requere+' class="singlet_2 form-control PlandeCuenta" name="pagosde'+nextinput2+'" title="Seleccione un Plan de Cuenta" data-fila="selectiomimuesto'+nextinput+'"></select>'+
  '</div></div><div class="form-group col-md-2"><div class="input-group input-group-sm">'+
  '<input '+requere+'   type ="text" data-id="'+nextinput2+'" id="money'+nextinput2+'" name="money'+nextinput2+'" class="form-control monto money'+nextinput2+'"  autofocus onkeyup="jquerycontrol(this)" >'+
  '<input type="hidden" name="montoInput'+nextinput2+'" id="montoInput'+nextinput2+'" class="montoInput'+nextinput2+'" value=""></div>'+
  '<span class ="AP text-danger"></span>  </div><div class="form-group col-md-3 col-lg-push"><div class="input-group input-group-sm">'+
  '<select name="selectiomimuesto'+nextinput2+'" data-id="'+nextinput2+'" id="selectiomimuesto'+nextinput2+'" class="form-control jquerycontrol none " '+de_be+' '+none+' onchange="jquerycontrol(this)" required="required" style="width: 110px;">'+
  '<option value="0">Excenta</option>    </option><option value="11">IVA 10 %</option><option value="21">IVA 5 %</option></select><div class="input-group-btn"></div>'+
  '<input  type ="text" id="ivaimput'+nextinput2+'" name="ivaimput'+nextinput2+'" class="form-control  none " '+de_be+' '+none+'  autofocus value="0" ></div></div>'+
  '<div class="form-group col-md-1 col-lg-push text-center "><div class="input-group input-group-sm">'+
  '<span class="input-group-btn"><button  onclick="remove2('+nextinput2+')" data-id="'+nextinput2+'" class="btn btn-sm btn-danger btn-flat" type="button" data-select2-open="single-prepend-text"><i class="fa fa-minus" aria-hidden="true"></i></button>'+
  '</span></div><span class ="AP text-danger"></span>   </div> </div>';

                $("#Contenedor1").append(conten);
                $("#pagosde"+nextinput2).select2(ajaxsinglet()).change(function(event) {
                  selectinpuesto( $(this) )
                });
                $(".money"+nextinput2+",#ivaimput"+nextinput2).mask('000.000.000.000.000', {reverse: true}); 
                $('#cantidad_debe').val(nextinput2);

                switch(true) {
                  case control == 4:
                      $('.none').val('').prop('required', false);
                    break;
                  case control == 2 || control == 3:
                      $('[name="selectiomimuesto'+nextinput2+'"]').val('');
                      $("#ivaimput"+nextinput2).val(''); 
                      $('.debe').val('');                    
                    break;

                }
                nextinput2 ++; 
  }else{
     toastem.error('8 Maximo elemento ');
    return false;

  }
}


function addNewButtonHaber(e) {
  var val = $(this).attr("data-id");
  if (nextinput < maxDiv) {
  conten = '<div id="div_'+nextinput+'" class="add_div_new">'+
      '<div class="form-group col-md-6"><div class="input-group input-group-sm">'+
        '<select id="PlandeCuenta'+nextinput+'" '+requere+' class="singlet_2 form-control PlandeCuenta" name="PlandeCuenta'+nextinput+'" title="Seleccione un Plan de Cuenta" data-fila="selecthaber'+nextinput+'"> </select>'+
      '</div></div><div class="form-group col-md-2"><div class="input-group input-group-sm">'+
      '<input '+requere+'   type ="text" id="monto_haber'+nextinput+'" data-id="'+nextinput+'" name="monto_haber'+nextinput+'" class="form-control monto monto_haber'+nextinput+'"  autofocus onkeyup="jqueryhaber(this)">'+
      '<input type="hidden" name="montohaber'+nextinput+'" id="montohaber'+nextinput+'" class="montohaber'+nextinput+'" value="">'+
      '</div><span class ="AP text-danger"></span>   </div><div class="form-group col-md-3 col-lg-push"><div class="input-group input-group-sm">'+
      '<select name="selecthaber'+nextinput+'" id="selecthaber'+nextinput+'" data-id="'+nextinput+'" class="form-control jquerycontrol none " '+haber+' '+none+' onchange="jqueryhaber(this)" required style="width: 110px;"><option value="0">Excenta</option>    </option><option value="11">IVA 10 %</option><option value="21">IVA 5 %</option></select><div class="input-group-btn"></div><input  type ="text" id="ivahaber'+nextinput+'" name="ivahaber'+nextinput+'" class="form-control  none  " '+haber+' '+none+'  autofocus value="0"  ></div></div><div class="form-group col-md-1 col-lg-push text-center "><div class="input-group input-group-sm"><span class="input-group-btn"><button onclick="remove('+nextinput+')" data-id="'+nextinput+'" class="btn btn-sm btn-danger btn-flat" type="button" data-select2-open="single-prepend-text"><i class="fa fa-minus" aria-hidden="true"></i>      </button></span></div></div> </div>       ';

                    $("#Contenedor").append(conten);
                    $("#PlandeCuenta"+nextinput).select2(ajaxsinglet()).change(function(event) {
                      selectinpuesto( $(this) )
                    });
                    $(".monto_haber"+nextinput+",#ivahaber"+nextinput).mask('000.000.000.000.000', {reverse: true});
                    $('#cantidad_haber').val(nextinput);

                    switch(true) {
                      case control == 4:
                          $('.none').val('').prop('required', false);
                        break;
                      case control == 1:
                          $('[name="selecthaber'+nextinput+'"]').attr('disabled','disabled').val('');
                          $('.haber,#ivahaber'+nextinput).val('');                          
                        break;
                    }
                    nextinput ++; 
                  
      }else{
        toastem.error('8 Maximo elemento ');
        return false;

      }
 }

/**
 * [jquerycontrol description]
 */
// function jquerycontrol(sel) { // debe
//   let money,value,des_obtenido;
//   let id        = sel.getAttribute('data-id');
//   let totaldebe = 0;
//   let cdebe     =  document.getElementById("cantidad_debe").value;


//  var int =[];
//     $('#ivaimput'+id).val('');
//      money        = sanearnum(document.getElementsByName("money"+id)[0].value);
//      if ( document.getElementsByName("selectiomimuesto"+id).length ) {
//       value        = document.getElementsByName("selectiomimuesto"+id)[0].value;
//       }else{
//         value = '';
//       }
     

//       if (money > 0) {
//         $('#ivaimput'+id).attr('required', 'required');
//       }else {

//           $('#ivaimput'+id).removeAttr('required');
//       }


//      if (money > 0 && value > 0) {
//       var final      = operaciones(money,value,'/').toFixed(2);
//       var finalmoney = operaciones(money, final, '-');
//       document.getElementById("montoInput"+id).value = finalmoney;
//       document.getElementById("ivaimput"+id).value = final;


//     }else{
//       if (value == '0') {
//            document.getElementById("ivaimput"+id).value = money;
//            document.getElementById("montoInput"+id).value = money;
//       }else{
//         if (document.getElementsByName("ivaimput"+id).length ) {
//               document.getElementById("ivaimput"+id).value = '';
//         }
          
//           document.getElementById("montoInput"+id).value = money;
//       }

       
//     }


//       for (var i = cdebe; i >= 0; i--) {
//         S = sanearnum(document.getElementsByName("money"+i)[0].value);
//         if (S != '') {
//           int[i] = S;
//           totaldebe = totaldebe + parseInt(int[i]);

//         }
//       }


//       $('#totaldebe').val(formatNumber.new(totaldebe));
//       $('#input_totaldebe').val(totaldebe);
//       difnca();
     
//     if (control == 1) {
//            var lc = document.getElementById('pagosde'+id).value;
//       if(lc == 30 || lc == 31 || lc == 32){
         
//         methodCuenta (id,value,sel.name);
//       }

//     }
// }
function jquerycontrol(sel) {
  const id = sel.getAttribute('data-id');
  let totaldebe = 0;

  // Obtener el valor del input de cantidad debe
  const cdebe = document.getElementById("cantidad_debe").value;

  // Obtener el valor del input de dinero del item actual
  const money = sanearnum($(`[name="money${id}"]`).val());

  // Obtener el valor seleccionado del select de impuesto del item actual
  const value = $(`[name="selectiomimuesto${id}"]`).val() || '';

  // Asignar el valor al input de impuesto dependiendo del valor de dinero y del impuesto seleccionado
  if (money > 0) {
    $('#ivaimput' + id).attr('required', 'required');
    if (value > 0) {
      const final = operaciones(money, value, '/').toFixed(2);
      const finalmoney = operaciones(money, final, '-');
      $(`#montoInput${id}`).val(finalmoney);
      $(`#ivaimput${id}`).val(final);
    } else {
      $(`#ivaimput${id}`).val(money);
      $(`#montoInput${id}`).val(money);
    }
  } else {
    $(`#ivaimput${id}`).val('');
    $(`#montoInput${id}`).val(money);
    $('#ivaimput' + id).removeAttr('required');
  }

  // Calcular el total del debe
  const int = [];
  for (let i = cdebe; i >= 0; i--) {
    const s = sanearnum($(`[name="money${i}"]`).val());
    if (s) {
      int[i] = s;
      totaldebe += parseInt(s, 10);
    }
  }

  // Actualizar el valor de los inputs de total debe
  $('#totaldebe').val(formatNumber.new(totaldebe));
  $('#input_totaldebe').val(totaldebe);

  // Llamar a la función difnca para actualizar los inputs correspondientes
  difnca();

  // Verificar si la variable control es igual a 1 y si es así, llamar a la función methodCuenta con los parámetros correspondientes
  if (control === 1) {
    const lc = $(`#pagosde${id}`).val();
    if (lc == 30 || lc == 31 || lc == 32) {
      methodCuenta(id, value, sel.name);
    }
  }
}

/**
 * [jqueryhaber description]
 */
function jqueryhaber(sel) {
  let id = sel.getAttribute('data-id');
  let totalHaber = 0;
  let int = [];

  const monto = sanearnum(document.getElementsByName(`monto_haber${id}`)[0].value);
  const value = document.getElementsByName(`selecthaber${id}`)[0]?.value ?? '';

  $('#ivahaber' + id).val('');

  if (monto > 0) {
    $('#ivahaber' + id).attr('required', 'required');
  } else {
    $('#ivahaber' + id).removeAttr('required');
  }

  if (monto > 0 && value > 0) {
    const final = operaciones(monto, value, '/').toFixed(2);
    const finalMonto = operaciones(monto, final, '-');
    document.getElementById(`montohaber${id}`).value = finalMonto;
    document.getElementById(`ivahaber${id}`).value = final;
  } else {
    if (value === '0') {
      document.getElementById(`ivahaber${id}`).value = monto;
      document.getElementById(`montohaber${id}`).value = monto;
    } else {
      if (document.getElementsByName(`ivahaber${id}`).length) {
        document.getElementById(`ivahaber${id}`).value = '';
      }
      document.getElementById(`montohaber${id}`).value = monto;
    }
  }

  const cdebe = document.getElementById('cantidad_haber').value;
  for (let i = cdebe; i >= 0; i--) {
    const s = sanearnum(document.getElementsByName(`monto_haber${i}`)[0].value);
    if (s !== '') {
      int[i] = s;
      totalHaber += parseInt(int[i]);
    }
  }

  $('#totalhaber').val(formatNumber.new(totalHaber));
  $('#input_totalhaber').val(totalHaber);

  difnca();

  if (control === 2 || control === 3) {
    const lc = document.getElementById(`PlandeCuenta${id}`).value;
    if (lc === 185 || lc === 186 || lc === 336) {
      methodCuenta(id, value, sel.name);
    }
  }
}



// function jqueryhaber(sel) {
//  let monto,value,des_obtenido;
//  let id = sel.getAttribute('data-id');
//  let totalhaber = 0;
//  let totaivar = 0;
//  let cdebe =  document.getElementById("cantidad_haber").value;
//  var int =[];
//     $('#ivahaber'+id).val('');

//      monto        = sanearnum(document.getElementsByName("monto_haber"+id)[0].value);
//      if ( document.getElementsByName("selecthaber"+id).length ) {
//       value        = document.getElementsByName("selecthaber"+id)[0].value;
//       }else{
//         value = '';
//       }

//         if (monto > 0) {
//           $('#ivahaber'+id).attr('required', 'required');
//         }else {
//           $('#ivahaber'+id).removeAttr('required');
//         }


//      if (monto > 0 && value > 0) {
//       var final      = operaciones(monto,value,'/').toFixed(2);
//       var finalmonto = operaciones(monto, final, '-');
//       document.getElementById("montohaber"+id).value = finalmonto;
//       document.getElementById("ivahaber"+id).value = final;


//     }else{
//       if (value == '0') {
//            document.getElementById("ivahaber"+id).value = monto;
//            document.getElementById("montohaber"+id).value = monto;
//       }else{
//           if (document.getElementsByName("ivahaber"+id).length ) {
//               document.getElementById("ivahaber"+id).value = '';
//           }
//           document.getElementById("montohaber"+id).value = monto;
//       }
//     }
    


//       for (var i = cdebe; i >= 0; i--) {
//         S = sanearnum(document.getElementsByName("monto_haber"+i)[0].value);
//         if (S != '') {
//           int[i] = S;
//           totalhaber = totalhaber + parseInt(int[i]);
//         }


//      }

//       $('#totalhaber').val(formatNumber.new(totalhaber));
//       $('#input_totalhaber').val(totalhaber);
//       difnca();
//     if (control == 2 ||  control == 3) {
//       var lc = document.getElementById('PlandeCuenta'+id).value;    
//       if(lc == 185 || lc == 186 || lc == 336){
//         methodCuenta (id,value,sel.name);
//       }

//     }
// }


/**
 * [methodCuenta description]
 */
function methodCuenta (id,val,nam) {   
    if (control == 1 && nam == 'selectiomimuesto'+id) {
     switch(val) {
        case '0':
               $('#pagosde'+id).html('').append(new Option('Mercaderias  exentas del iva', '32', true, true));
        break;
        case '11':
               $('#pagosde'+id).html('').append(new Option('Mercaderias  gravadas por el iva al 10%', '30', true, true));
          break;
        case '21':
               $('#pagosde'+id).html('').append(new Option('Mercaderias  gravadas por el iva al 5%', '31', true, true));
          break;
      }
       $('#PlandeCuenta0').html('').append(new Option('Caja', '5', true, true));

    }
    if ((control == 2 ||  control == 3) && nam == 'selecthaber'+id) {


     switch(val) {
      case '0':
               $('#PlandeCuenta'+id).html('').append(new Option('Ventas de mercaderías exentas  del iva', '336', true, true));
        break;
        case '11':
               $('#PlandeCuenta'+id).html('').append(new Option('Ventas de mercaderías gravadas por 10%', '185', true, true));
          break;
        case '21':
               $('#PlandeCuenta'+id).html('').append(new Option('Ventas de mercaderías gravadas por 5%', '186', true, true));
          break;
      }
          $('#pagosde0').html('').append(new Option('Caja', '5', true, true));
    }

}
// function methodCuenta(id, val, nam) {
//   const $pagosDe = $('#pagosde' + id);
//   const $planDeCuenta = $('#PlandeCuenta' + id);

//   if (control === 1 && nam === `selectiomimuesto${id}`) {
//     switch (val) {
//       case '0':
//         $pagosDe.empty().append($('<option>', { value: '32', text: 'Mercaderias exentas del iva', selected: true }));
//         break;
//       case '11':
//         $pagosDe.empty().append($('<option>', { value: '30', text: 'Mercaderias gravadas por el iva al 10%', selected: true }));
//         break;
//       case '21':
//         $pagosDe.empty().append($('<option>', { value: '31', text: 'Mercaderias gravadas por el iva al 5%', selected: true }));
//         break;
//     }

//     $planDeCuenta.empty().append($('<option>', { value: '5', text: 'Caja', selected: true }));
//   }

//   if ((control === 2 || control === 3) && nam === `selecthaber${id}`) {
//     switch (val) {
//       case '0':
//         $planDeCuenta.empty().append($('<option>', { value: '336', text: 'Ventas de mercaderías exentas del iva', selected: true }));
//         break;
//       case '11':
//         $planDeCuenta.empty().append($('<option>', { value: '185', text: 'Ventas de mercaderías gravadas por 10%', selected: true }));
//         break;
//       case '21':
//         $planDeCuenta.empty().append($('<option>', { value: '186', text: 'Ventas de mercaderías gravadas por 5%', selected: true }));
//         break;
//     }

//     $('#pagosde0').empty().append($('<option>', { value: '5', text: 'Caja', selected: true }));
//   }
// }



/**
 * Metodo para mostrar resultado de diferencia entre el total de haber y debe
 * @return {[type]} [description]
 */
 function difnca() {

  let totalDebe = parseFloat($('#input_totaldebe').val()) || 0;
  let totalHaber = parseFloat($('#input_totalhaber').val()) || 0;
  let diferencia = Math.abs(totalDebe - totalHaber);
  if (isNaN(diferencia)) {
    $('#input_Diferencia').val("");
  } else {
    $('#input_Diferencia').val(diferencia.toFixed(0));
  }
 
}

/**
 * [addclien metodo para mostrar modal de add proveedor]
 * @return {[type]}           [description]
 */
function addclien(arguments) {
  argumento = arguments;
 if (argumento == 'Empresa') {
   Item_add = 'Item_add';
   $('#ruc').mask('0000000########-0', {reverse: true});

 }
 if (argumento == 'Proveedor'){
  Item_add = 'Proveedor/ajax_add2';
    let val = $('#tipoIdentificacion').val();
    $('#ruc').mask('0000000####-0', {reverse: true});
    switch(true) {
      case val == 12 || val == 13 || val == 14 || val == 16 || val == 17:
        $('#ruc').mask('0000000########', {reverse: true});
      break;
    }
 }
 $('.modal-title').text('Nuevo  '+argumento);
 $('#estado').val(argumento);
 $(".NOM,.TE,.RUC").html("").css({"display":"none"});
 $("#inserc,.modal-header").show();
 $('#inserc')[0].reset();
 $('#database').val($('#Empresa').val());
 $('#modal-1').modal('show');

}

function resetear (){
  $('#Declaraciones').val('').change();
}


/**
 * [Insercion de un nuevo PROVEEDOR]
 * @param 
 * @return {[type]}             [description]
 */
$(function() {
  $('#inserc').submit(function(e) {
      
    $(".NOM,.TE,.RUC").html("").css({"display":"none"});
    $nom = $('#Nombre').val();
    $ruc = $('#ruc').val();
    $b = $('#loading');
      $.ajax({
        url: Item_add,
        type: "POST",
        dataType: "JSON",
        cache: false,
        data:  $(this).serialize(),
        beforeSend: function(){
        $('#btnSave').attr("disabled","disabled");
        $b.button("loading");
        },
      })
      .done(function(data) {
          $b.button("reset");
          $('#btnSave').removeAttr('disabled');
          if (data.res == 'error') {

              if (data.Nombre) {
                 $(".NOM").html(data.Nombre).css({"display":"block"}); // mostrar validation de iten usuario
              }
               if (data.ruc || data.Ruc) {
                 $(".RUC").html(data.ruc).css({"display":"block"}); // mostrar validation de iten usuario
              }
              if (data.Telefono) {
                 $(".TE").html(data.Telefono).css({"display":"block"}); // mostrar validation de iten usuario
              }
          }else{
            if (argumento == 'Empresa') {
              $('[name ="Empresa"]').html(
                 $('<option>', {value:data, text:'['+$ruc+'] '+$nom },'</option>')
                );
            }else{
              $('[name ="selec_Proveedor"]').html(
                  $('<option>', {value:data, text:'[RUC: '+$nom+']   '+$ruc },'</option>')
                );

            }
              
                
                      Swal.fire({
                        type: 'success',
                        title: 'Agregado Correctamente',
                        showConfirmButton: false,
                        timer: 1000
                      });

                setTimeout(function() {
                    if (argumento == 'Empresa') {
                      $('#Empresa').val(data).trigger("change");
                    }else{
                      $('#selec_Proveedor').val(data).trigger("change");
                    }
                      $('#modal-1').modal('hide');
                },2000);
          }
      })
      .fail(function(data) {
        toastem.error('error');
      })
      .always(function(data) {
      });
    e.preventDefault();
  });





});
