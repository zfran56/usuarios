$(document).ready(function () {
        $('#btnNuevo').on('click',function(){

            $('#cambiarPassword').css('display', 'none');
            $('#usuario').attr('readonly',false);
            $('#usuario').attr('value','');
            $('#btnAgregar').attr('value','Guardar');
            $('#formulario').each(function(){
              this.reset();
            });
    		$('#registra-producto').modal({
    			show:true,
    			backdrop:'static'
    		});
    	});

        $("#btnConfirmar").on('click', function(ev)
        {
            eliminarRegistro();
        });


        $("#btnAgregar").on('click', function(ev)
        {
            var usuario=$("#usuario").val();
            var nombre=$("#nombre").val();
            var apellido=$("#apellido").val();
            var password=$("#password").val();
            var nivel=$("#id_nivel").val();
            $("#resultados").html("<img src='assets/images/loader_small.gif'>");
            if($("#btnAgregar").val() =="Guardar"){
                //Guardar

                var estado = false;
                estado = validarCampo("#usuario");
                estado = validarCampo("#password");
                estado = validarCampo("#confirmar");
                estado = validarCampo("#id_nivel");

                if(validarCampo("#password")==true && validarCampo("#confirmar")==true){
                    if($("#confirmar").val() != $("#password").val()){
                        alert('Los passwords no coinciden');
                        estado = false;
                    }else{
                        estado = true;
                    }
                }else{
                    estado = false;
                }

                if(estado==true){
                    //Guardar
                    var dataString = {
                        "param1" : "agregar",
                        "usuario" : usuario,
                        "nombre":nombre,
                        "apellido":apellido,
                        "password":password,
                        "nivel":nivel
                    };

                    $.ajax({
        				data:dataString,
        				type:"POST",
        				dataType:"json",
        				url:"class/admin-usuarios-espejo.php"
        			}).done(function(data,textStatus,jqXHR){

                        if(data.estado==true){
                            $("#resultados").html("");
                            alert("Usuario registrado con exito");
                            buscar();
                            $('#registra-producto').modal('hide');
                        }else{
                            alert("Error: "+ data.mensaje);
                        }
        			}).fail(function(jqXHR,textStatus,textError){
        			    $("#resultados").html("");
        				alert("Error al realizar la peticion: "+ textError);
        			});
                }
            }else{
                //Modificar
                var estado = false;
                estado = validarCampo("#usuario");
                estado = validarCampo("#id_nivel");

                var cambiarPassword = false;
                if($("#chkCambiar").is(':checked')) {
                    estado = validarCampo("#password");
                    estado = validarCampo("#confirmar");
                    if(validarCampo("#password")==true && validarCampo("#confirmar")==true){
                        if($("#confirmar").val() != $("#password").val()){
                            alert('Los passwords no coinciden');
                            estado = false;
                        }else{
                            estado = true;
                            cambiarPassword = true;
                        }
                    }else{
                        estado = false;
                        cambiarPassword = false;
                    }
                }else {
                    cambiarPassword = false;
                }



                if(estado==true){
                    //Modificar
                    var dataString = {
                        "param1" : "modificar",
                        "usuario" : usuario,
                        "nombre":nombre,
                        "apellido":apellido,
                        "password":password,
                        "nivel":nivel,
                        "cambiar": cambiarPassword
                    };

                    $.ajax({
        				data:dataString,
        				type:"POST",
        				dataType:"json",
        				url:"class/admin-usuarios-espejo.php"
        			}).done(function(data,textStatus,jqXHR){

                        if(data.estado==true){
                            $("#resultados").html("");
                            alert("Datos modificados con exito");
                            buscar();
                            $('#registra-producto').modal('hide');
                        }else{
                            alert("Error: "+ data.mensaje);
                        }
        			}).fail(function(jqXHR,textStatus,textError){
        			    $("#resultados").html("");
        				alert("Error al realizar la peticion: "+ textError);
        			});
                }


            }
            ev.preventDefault();
        });

        //Validaciones
        $("#usuario").on('blur', function(ev){
            ev.preventDefault();
            validarCampo("#usuario");
        });

        $("#password").on('blur', function(ev){
            ev.preventDefault();
            validarCampo("#password");
        });

        $("#confirmar").on('blur', function(ev){
            ev.preventDefault();
            validarCampo("#confirmar");
        });

        $("#id_nivel").on('blur', function(ev){
            ev.preventDefault();
            validarCampo("#id_nivel");
        });

        window.cambiarEstado = function(est,user) {
            $("#miTabla").html("<tr><td colspan='5' align='center'><img src='assets/images/loader.gif'></td></tr>");
            $.ajax({
    				data:{"param1":"cambiar","estado": est,"usuario": user},
    				type:"GET",
    				dataType:"json",
    				url:"class/admin-usuarios-espejo.php"
    			}).done(function(data,textStatus,jqXHR){
                    if(data.estado==true){
                        buscar();
                    }else{
                        alert("Error: "+ data.mensaje);
                        buscar();
                    }
    			}).fail(function(jqXHR,textStatus,textError){
    				alert("Error al realizar la peticion cuantos ");
                    buscar();
    			});

        }

        window.editarRegistro = function(usuario){
            $('#formulario').each(function(){
              this.reset();
            });
            $('#cambiarPassword').css('display', 'block');
            $('#btnAgregar').attr('value','Modificar');
            $('#usuario').attr('value',usuario);
            $('#usuario').attr('readonly',true);

            $.ajax({
    				data:{"param1":"ver","usuario": usuario},
    				type:"GET",
    				dataType:"json",
    				url:"class/admin-usuarios-espejo.php"
    			}).done(function(data,textStatus,jqXHR){

                    if(data.estado==true){
                        $('#nombre').attr('value',data.nombre);
                        $('#apellido').attr('value',data.apellido);
                        $('#id_nivel').val(data.nivel);
                        $('#registra-producto').modal({
                			show:true,
                			backdrop:'static'
                		});
                    }else{
                        alert("Error: "+ data.mensaje);
                    }
    			}).fail(function(jqXHR,textStatus,textError){
    				alert("Error al realizar la peticion "+ textError);
    			});


        }

        window.confirmarRegistro = function(user) {
            $('#id_registro').attr('value',user);
            $('#frmConfirmar').modal({
    			show:true,
    			backdrop:'static'
    		});
        }

        window.eliminarRegistro = function() {
            var user = $('#id_registro').val();
            $("#miTabla").html("<tr><td colspan='5' align='center'><img src='assets/images/loader.gif'></td></tr>");
            $.ajax({
    				data:{"param1":"eliminar","usuario": user},
    				type:"POST",
    				dataType:"json",
    				url:"class/admin-usuarios-espejo.php"
    			}).done(function(data,textStatus,jqXHR){
                    if(data.estado==true){
                        alert("Se elimino el registro");
                        buscar();
                        $('#frmConfirmar').modal('hide');
                    }else{
                        alert("Error: "+ data.mensaje);
                    }
    			}).fail(function(jqXHR,textStatus,textError){
    				alert("Error al realizar la peticion cuantos "+ textError);
    			});

        }

        function validarCampo(campo){
            if($(campo).val()==""){
                $(campo).removeClass("form-control").addClass("form-control ferror");
                $(campo).focus();
                return false;
            }else{
                $(campo).removeClass("form-control ferror").addClass("form-control");
                return true;
            }
        }
        //Fin Validaciones

        //Paginador

        buscar();

        $("#btnBuscar").on('click', function(ev)
        {
            ev.preventDefault();
            buscar();
        });


        $("#criterio").on('keyup change', function () {
            buscar();
        });

        function buscar(){
          var filtro = $("#criterio").val();
          if(filtro.length >2 || filtro.length ==0){
                $.ajax({
    				data:{"param1":"cuantos","filtro": filtro},
    				type:"GET",
    				dataType:"json",
    				url:"class/admin-usuarios-espejo.php"
    			}).done(function(data,textStatus,jqXHR){
    				var total = data.total;
                    $(".pagination li").remove();
    				creaPaginador(total);
    			}).fail(function(jqXHR,textStatus,textError){
    				alert("Error al realizar la peticion cuantos "+ textError);
    			});
          }
        }



        var paginador;
		var totalPaginas
		var itemsPorPagina = 20;
		var numerosPorPagina = 3;

		function creaPaginador(totalItems)
		{
		    $(".pagination li").remove();
			paginador = $(".pagination");
			totalPaginas = Math.ceil(totalItems/itemsPorPagina);

			$('<li><a href="#" class="first_link"><</a></li>').appendTo(paginador);
			$('<li><a href="#" class="prev_link">�</a></li>').appendTo(paginador);

			var pag = 0;
			while(totalPaginas > pag){
				$('<li><a href="#" class="page_link">'+(pag+1)+'</a></li>').appendTo(paginador);
				pag++;
			}
			if(numerosPorPagina > 1)
			{
				$(".page_link").hide();
				$(".page_link").slice(0,numerosPorPagina).show();
			}

			$('<li><a href="#" class="next_link">�</a></li>').appendTo(paginador);
			$('<li><a href="#" class="last_link">></a></li>').appendTo(paginador);

			paginador.find(".page_link:first").addClass("active");
			paginador.find(".page_link:first").parents("li").addClass("active");
			paginador.find(".prev_link").hide();
			paginador.find("li .page_link").click(function()
			{
				var irpagina =$(this).html().valueOf()-1;
				cargaPagina(irpagina);
				return false;
			});

			paginador.find("li .first_link").click(function()
			{
				var irpagina =0;
				cargaPagina(irpagina);
				return false;
			});

			paginador.find("li .prev_link").click(function()
			{
				var irpagina =parseInt(paginador.data("pag")) -1;
				cargaPagina(irpagina);
				return false;
			});

			paginador.find("li .next_link").click(function()
			{
				var irpagina =parseInt(paginador.data("pag")) +1;
				cargaPagina(irpagina);
				return false;
			});

			paginador.find("li .last_link").click(function()
			{
				var irpagina =totalPaginas -1;
				cargaPagina(irpagina);
				return false;
			});
			cargaPagina(0);
		}

		function cargaPagina(pagina)
		{
			var desde = pagina * itemsPorPagina;
            var filtro = $("#criterio").val();
            $("#miTabla").html("<tr><td colspan='5' align='center'><img src='assets/images/loader.gif'></td></tr>");
			$.ajax({
				data:{"param1":"dame","limit":itemsPorPagina,"offset":desde,"filtro":filtro},
				type:"GET",
				dataType:"json",
				url:"class/admin-usuarios-espejo.php"
			}).done(function(data,textStatus,jqXHR){
				var lista = data.lista;
				$("#miTabla").html("");

                var a=0;
				$.each(lista, function(ind, elem){
                    a++;
					$("<tr>"+
						"<td>"+a+"</td>"+
						"<td>"+elem.nombre+" "+ elem.apellido +"</td>"+
						"<td>"+elem.id+"</td>"+
						"<td>"+elem.nivel+"</td>"+
						"<td>"+elem.estado+"</td>"+
						"<td><center>"+elem.iconos+"</center></td>"+
						"</tr>"
                    ).appendTo($("#miTabla"));


				});

			}).fail(function(jqXHR,textStatus,textError){
			    //alert('Funciono? '+ jqXHR[0]);
				alert("Error al realizar la peticion: "+ textError);
			});

			if(pagina >= 1){
				paginador.find(".prev_link").show();

			}
			else{
				paginador.find(".prev_link").hide();
			}


			if(pagina <(totalPaginas- numerosPorPagina))
			{
				paginador.find(".next_link").show();
			}else
			{
				paginador.find(".next_link").hide();
			}
			paginador.data("pag",pagina);
			if(numerosPorPagina>1)
			{
				$(".page_link").hide();
				if(pagina < (totalPaginas- numerosPorPagina))
				{
					$(".page_link").slice(pagina,numerosPorPagina + pagina).show();
				}
				else{
					if(totalPaginas > numerosPorPagina)
						$(".page_link").slice(totalPaginas- numerosPorPagina).show();
					else
						$(".page_link").slice(0).show();
				}
			}
			paginador.children().removeClass("active");
			paginador.children().eq(pagina+2).addClass("active");
		}
        //Fin Paginador


    });
