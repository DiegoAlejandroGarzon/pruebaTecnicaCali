$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#saveUser').on('click', function(){
        Swal.fire({
            title: 'Cargando datos...',
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
            }
        })
        datas = new FormData();
        datas.append("firstName",$("input[name=firstName]").val());
        datas.append("secondName",$("input[name=secondName]").val());
        datas.append("surname",$("input[name=surname]").val());
        datas.append("secondSurname",$("input[name=secondSurname]").val());
        datas.append("documentType",$("select[name=documentType]").val());
        datas.append("documentNumber",$("input[name=documentNumber]").val());
        datas.append("email",$("input[name=email]").val());
        datas.append("password",$("input[name=password]").val());
        $.ajax({
            "dataSrc":"data",
            type:'POST',
            url:"/createUser",
            data:datas,
            processData:false,
            contentType:false,
            success:function(data){
                if(data.error == 'on'){
                    Swal.fire({
                        icon: 'error',
                        title: data.mensaje,
                        showConfirmButton: true,
                        // timer: 2500
                    })
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: data.mensaje,
                        showConfirmButton: false,
                        timer: 2500
                    })
                    tablaUsuarios.ajax.reload();
                }
            },error:function(msj){
                mensajeDeErrores = "";
                var errores = msj.responseJSON.errors;
                for(var error in errores){
                    mensajeDeErrores = mensajeDeErrores+errores[error]+"<br>"
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Revisa el formulario nuevamente',
                    showConfirmButton: true,
                    html: mensajeDeErrores,
                    // timer: 1500
                })
            }
        })
    })

    var tablaUsuarios = $('#tablaUsuarios').DataTable({
        responsive: true,        
        "ajax":"/usersList",
        "columns":[
            {'defaultContent':''},
            {data:'firstName'},
            {data:'secondName'},
            {data:'surname'},
            {data:'secondSurname'},
            {data:'documentType'},
            {data:'documentNumber'},
            {data:'email'},
            {'defaultContent' :'<center><button class="edit btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit"><i class="fas fa-edit"></i></button><button class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></center>'},
        ],
    });
    tablaUsuarios.on('order.dt search.dt', function () {
        tablaUsuarios.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            tablaUsuarios.cell(cell).invalidate('dom');
        });
    }).draw();

    $('#tablaUsuarios tbody').on('click','button.edit', function(e){
        //var usuarionEditar = tablaUsuario.row($(this)).data().id;
        var registro = tablaUsuarios.row(($(this)).parents("tr")).data();
        console.log(registro);
        $('#idUser').val(registro.id);
        $('#firstNameEdit').val(registro.firstName);
        $('#secondNameEdit').val(registro.secondName);
        $('#surnameEdit').val(registro.surname);
        $('#secondSurnameEdit').val(registro.secondSurname);
        $('#documentTypeEdit').val(registro.documentType);
        $('#documentNumberEdit').val(registro.documentNumber);
        $('#emailEdit').val(registro.email);
        $('#roleActualEdit').val(registro.role);
    })
    
    $('#updateUser').on('click', function(){
        Swal.fire({
            title: 'Cargando datos...',
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
            }
        })
        datas = new FormData();
        datas.append("idUser",$("input[name=idUser]").val());
        datas.append("firstName",$("input[name=firstNameEdit]").val());
        datas.append("secondName",$("input[name=secondNameEdit]").val());
        datas.append("surname",$("input[name=surnameEdit]").val());
        datas.append("secondSurname",$("input[name=secondSurnameEdit]").val());
        datas.append("documentType",$("select[name=documentTypeEdit]").val());
        datas.append("documentNumber",$("input[name=documentNumberEdit]").val());
        datas.append("email",$("input[name=emailEdit]").val());
        $.ajax({
            "dataSrc":"data",
            type:'POST',
            url:"/updateUser",
            data:datas,
            processData:false,
            contentType:false,
            success:function(data){
                console.log(data);
                if(data.error == 'on'){
                    Swal.fire({
                        icon: 'error',
                        title: data.mensaje,
                        showConfirmButton: true,
                        // timer: 2500
                    })
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: data.mensaje,
                        showConfirmButton: false,
                        timer: 2500
                    })
                    tablaUsuarios.ajax.reload();
                }
            },error:function(msj){
                mensajeDeErrores = "";
                var errores = msj.responseJSON.errors;
                for(var error in errores){
                    mensajeDeErrores = mensajeDeErrores+errores[error]+"<br>"
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Revisa el formulario nuevamente',
                    showConfirmButton: true,
                    html: mensajeDeErrores,
                    // timer: 1500
                })
            }
        })
    })
    
    //ELIMINAR REGISTRO
    $('#tablaUsuarios tbody').on('click','button.delete', function(e){
            Swal.fire({
                title: 'Confirmar eliminación de Registro',
                showDenyButton: true,
                // showCancelButton: true,
                confirmButtonText: `Eliminar`,
                denyButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    var registro = tablaUsuarios.row(($(this)).parents("tr")).data();
                    $.ajax({
                        "dataSrc":"data",
                        type:'POST',
                        url:"/deleteUser/"+registro.id,
                        processData:false,
                        contentType:false,
                        success:function(data){
                            if(data.error == 'on'){
                                Swal.fire({
                                    icon: 'error',
                                    title: data.mensaje,
                                    showConfirmButton: true,
                                    // timer: 2500
                                })
                            }else{
                                tablaUsuarios.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: data.mensaje,
                                    showConfirmButton: false,
                                    timer: 2500
                                })
                                //window.location.reload();
                            }
                        }
                    })
                } else if (result.isDenied) {
                    Swal.fire('Eliminación Cancelada', '', 'info')
                }
            })
        //var usuarionEditar = tablaUsuario.row($(this)).data().id;
        
    });

});