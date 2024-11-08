<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Crear Ticket</title>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Crear Tickets') }}
            </h2>
        </x-slot>
 {{-- <h3 class="container" style="background-color: #1e3a8a; color: white" >Crear Ticket</h3> --}}
<div class="container"  style="background-color: #e6e6e6;">
    <form method="POST" action="{{ route('tickets.store') }}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Asunto Ticket</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Escribe el título del ticket" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción del Ticket</label>
            <textarea class="form-control" id="description" name="description" placeholder="Escribe una descripción para el ticket" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Estado</label>
            <select class="form-select" id="status" name="status" required>
                <option selected disabled value="">Selecciona el estado...</option>
                <option value="abierto">Abierto</option>
                <option value="en progreso">En progreso</option>
                <option value="finalizado">Cerrado</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="created_by" class="form-label">Creado por</label>
            <select class="form-select" id="created_by" name="created_by" required>
                <option selected disabled value="">Selecciona al creador del ticket...</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="assigned_to" class="form-label">Asignado a</label>
            <select class="form-select" id="assigned_to" name="assigned_to" required>
                <option selected disabled value="">Selecciona a quién asignar el ticket...</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('tickets.index') }}" class="btn btn-warning">Cancelar</a>
        </div>
    </form>
</x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</div>

</body>
</html>
