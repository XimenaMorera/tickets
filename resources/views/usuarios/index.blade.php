<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- <title>Listado de Usuarios</title> --}}
  </head>
  <body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Usuarios') }}
            </h2>
        </x-slot>
        <div class="container">
        {{-- <div class="row justify-content-center">
          <div class="col-md-3 col-lg-4">
              <input 
                  type="text" 
                  name="search" 
                  class="form-control" 
                  placeholder="Buscar por nombre o correo" 
                  value="{{ request('search') }}"
              >
          </div>
          <div class="col-md-2 col-lg-1">
              <button type="submit" class="btn btn-primary" style="background-color: darkblue">Buscar</button>
          </div>
      
    
    {{-- <h1>Listado de Usuarios</h1> --}}
    {{-- <div class="row col-md-2 ms">
      <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-sm" style="background-color: darkblue">Agregar Usuario</a>
   </div>
   --}}
   <div class="row justify-content-start mt-3">
    <!-- Formulario de búsqueda -->
    <form method="GET" action="{{ route('usuarios.index') }}" class="d-flex mb-1">
        <!-- Input de búsqueda más pequeño -->
        <input 
            type="text" 
            name="search" 
            class="form-control form-control-sm me-2" 
            placeholder="Buscar usuario" 
            value="{{ request('search') }}"
            style="width: 250px; height:20px " >
        <button class="btn btn-primary btn-sm" type="submit" style="background-color: darkblue">Buscar</button>
    </form>



<!-- Botón Agregar Usuario -->
<div class="row justify-content-end mb-2">
    <div class="col-auto">
      {{-- <a href="{{ route('register') }}" class="btn btn-primary btn-sm" style="background-color: darkblue">Agregar Usuario</a> --}}
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary btn-sm" style="background-color: darkblue">Agregar Usuario</a>
    </div>
</div>
</div>

    <div class="container"  data-bs-theme="blue">
    <table  class="table table-hover table-secondary">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Correo electrónico</th>
            <th scope="col">Rol</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td> <!-- Muestra el rol directamente -->
                <td>
                  <a href="{{ route('usuarios.edit', ['usuario' => $user->id]) }}" class="btn btn-info">Editar</a>

                  {{-- <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST" style="display: inline;">
                    @method('DELETE')
                    @csrf
                    <input class="btn btn-danger" type="submit" value="Eliminar">
                  </form> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
        </div>
</x-app-layout>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
