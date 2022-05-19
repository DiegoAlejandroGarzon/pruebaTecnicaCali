<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            USUARIOS
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card shadow" id="divTabla">
                                <div class="card-body py-3">
                                    <div>
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#modalCreateUser"><i class="fas fa-user-plus"></i> Agregar nuevo Usuario</button>
                                            </div>
                                        </div>
                                        <div >
                                            <br>
                                            <table id="tablaUsuarios" class="table display responsive nowrap" style="width:100%; display: block; overflow-x: auto;">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th >#</th>
                                                        <th >Primer Nombre</th>
                                                        <th >Segundo Nombre</th>
                                                        <th >Primer Apellido</th>
                                                        <th >Segundo Apellido</th>
                                                        <th >Tipo de documento</th>
                                                        <th >numero de documento</th>
                                                        <th >Email</th>
                                                        <th >Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="color:black"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modalCreateUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-0 font-weight-bold text-primary" id="staticBackdropLabel">Crear Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contenidoModalEdicion">
                        <div class="card-body py-3">
                            <form class="was-validated" id="formularioepsEditar">
                                <div class="mb-3">
                                    <label for="firstName">Primer Nombre</label><br>
                                    <input id="firstName" name="firstName" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="secondName">Segundo Nombre</label><br>
                                    <input id="secondName" name="secondName" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="surname">Primer Apellido</label><br>
                                    <input id="surname" name="surname" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="secondSurname">Segundo Apellido</label><br>
                                    <input id="secondSurname" name="secondSurname" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="documentType">Tipo de documento</label><br>
                                    <select name="documentType" id="documentType" class="custom-select" required>
                                        <option value="">Seleccione</option>
                                        <option value="Cedula de ciudadanía">Cedula de ciudadanía</option>
                                        <option value="Cedula de extranjería">Cedula de extranjería</option>
                                        <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                                        <option value="Pasaporte">Pasaporte</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="documentNumber">Numero de documento</label><br>
                                    <input id="documentNumber" name="documentNumber" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Correo</label><br>
                                    <input id="email" name="email" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Contraseña</label><br>
                                    <input id="password" name="password" type="password" class="form-control" required>
                                </div>
                            </form>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary limpiarErrores" data-dismiss="modal" >Cerrar</button>
                    <button class="btn btn-primary" id="saveUser">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-0 font-weight-bold text-primary" id="staticBackdropLabel">Editar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contenidoModalEdicion">
                        <div class="card-body py-3">
                            <form class="was-validated">
                                <input type="text" id="idUser" name="idUser">
                                <div class="mb-3">
                                    <label for="firstNameEdit">Primer Nombre</label><br>
                                    <input id="firstNameEdit" name="firstNameEdit" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="secondNameEdit">Segundo Nombre</label><br>
                                    <input id="secondNameEdit" name="secondNameEdit" type="text" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="surnameEdit">Primer Apellido</label><br>
                                    <input id="surnameEdit" name="surnameEdit" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="secondSurnameEdit">Segundo Apellido</label><br>
                                    <input id="secondSurnameEdit" name="secondSurnameEdit" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="documentTypeEdit">Tipo de documento</label><br>
                                    <select name="documentTypeEdit" id="documentTypeEdit" class="custom-select" required>
                                        <option value="">Seleccione</option>
                                        <option value="Cedula de ciudadanía">Cedula de ciudadanía</option>
                                        <option value="Cedula de extranjería">Cedula de extranjería</option>
                                        <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                                        <option value="Pasaporte">Pasaporte</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="documentNumberEdit">Numero de documento</label><br>
                                    <input id="documentNumberEdit" name="documentNumberEdit" type="text" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="emailEdit">Correo</label><br>
                                    <input id="emailEdit" name="emailEdit" type="text" class="form-control" required>
                                </div>
                            </form>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary limpiarErrores" data-dismiss="modal" >Cerrar</button>
                    <button class="btn btn-primary" id="updateUser">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    
@section('scripts')
    <script type="text/javascript" src="{{asset('js/users.js')}}"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" defer></script>
@endsection
</x-app-layout>
