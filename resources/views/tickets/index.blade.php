<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- <title>Listado de Tickets</title> --}}
  </head>
  <body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tickets') }}
            </h2>
        </x-slot>
    <div class="container"  data-bs-theme="blue">
    {{-- <h1>Listado de Tickets</h1> --}}
    <div class="row justify-content-start mt-3">
    <form method="GET" action="{{ route('tickets.index') }}" class="d-flex mb-1">
      <input 
          type="text" 
          name="search" 
          class="form-control form-control-sm me-2" 
          placeholder="Buscar ticket" 
          value="{{ request('search') }}"
      >
      <button class="btn btn-primary btn-sm" type="submit" style="background-color: darkblue">Buscar</button>
  </form>
</div>
    <div class="row justify-content-end mb-2">
      <div class="col-auto">
          <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-sm" style="background-color: darkblue">Crear ticket</a>
      </div>
  </div>
    <table class="table table-hover table-secondary">
        <thead >
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Título</th>
            <th scope="col">Estado</th>
            <th scope="col">Creado por</th>
            <th scope="col">Asignado a</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
            <tr>
                <th scope="row">{{ $ticket->id }}</th>
                <td>{{ $ticket->title }}</td>
                <td>{{ $ticket->status }}</td>
                <td>{{ $ticket->creator_name }}</td>
                <td>{{ $ticket->assignee_name }}</td>
                <td>
                  <a href="{{ route('tickets.edit', ['ticket' => $ticket->id]) }}" class="btn btn-info">Editar</a>

                  <form action="{{ route('tickets.destroy', ['ticket' => $ticket->id]) }}" method="POST" style="display: inline;">
                    @method('DELETE')
                    @csrf
                    <input class="btn btn-danger" type="submit" value="Eliminar">
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
</x-app-layout>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
