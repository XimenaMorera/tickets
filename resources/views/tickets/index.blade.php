<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Listado de Tickets</title>
  </head>
  <body>
    <div class="container">
    <h1>Listado de Tickets</h1>
    <a href="{{ route('tickets.create') }}" class="btn btn-success">Agregar Ticket</a>
    <table class="table">
        <thead>
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
                <td>{{ $ticket->creator->name }}</td>
                <td>{{ $ticket->assignee ? $ticket->assignee->name : 'No asignado' }}</td>
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

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
