<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Editar Ticket</title>
</head>
<body>
<div class="container">
    <h1>Editar Ticket</h1>
    <form method="POST" action="{{ route('tickets.update', ['ticket' => $ticket->id]) }}">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="id" class="form-label">Código del Ticket</label>
            <input type="text" class="form-control" id="id" aria-describedby="idHelp" name="id" disabled="disabled" value="{{ $ticket->id }}">
            <div id="idHelp" class="form-text">Código único del ticket</div>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $ticket->title) }}" placeholder="Escribe el título del ticket" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" placeholder="Escribe una descripción para el ticket" rows="4" required>{{ old('description', $ticket->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Estado</label>
            <select class="form-select" id="status" name="status" required>
                <option disabled value="">Selecciona el estado...</option>
                <option value="abierto" {{ old('status', $ticket->status) == 'abierto' ? 'selected' : '' }}>Abierto</option>
                <option value="en progreso" {{ old('status', $ticket->status) == 'en progreso' ? 'selected' : '' }}>En progreso</option>
                <option value="finalizado" {{ old('status', $ticket->status) == 'finalizado' ? 'selected' : '' }}>Cerrado</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="created_by" class="form-label">Creado por</label>
            <select class="form-select" id="created_by" name="created_by" required>
                <option selected disabled value="">Selecciona al creador del ticket...</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $ticket->created_by == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="assigned_to" class="form-label">Asignado a</label>
            <select class="form-select" id="assigned_to" name="assigned_to" required>
                <option selected disabled value="">Selecciona a quién asignar el ticket...</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $ticket->assigned_to == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('tickets.index') }}" class="btn btn-warning">Cancelar</a>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</div>
</body>
</html>
