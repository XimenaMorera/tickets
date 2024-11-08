<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Editar Usuario</title>
</head>
<body>
    <h3 class="container" style="background-color: #1e3a8a; color: white">Editar Usuario</h3>
    <div class="container" style="background-color: #e6e6e6;">
        <form method="POST" action="{{ route('usuarios.update', $user->id) }}">
            @csrf
            @method('PUT') <!-- Cambia el método a PUT para la actualización -->

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Escribe el nombre del usuario" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Escribe el correo electrónico del usuario" required>
            </div>

            <!-- Puedes optar por dejar el campo de contraseña vacío para no modificarla, o añadir un mensaje aclaratorio -->
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Dejar en blanco si no desea cambiarla">
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Rol</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="administrador" {{ old('role', $user->role) == 'administrador' ? 'selected' : '' }}>Administrador</option>
                    <option value="soporte" {{ old('role', $user->role) == 'soporte' ? 'selected' : '' }}>Soporte</option>
                </select>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-warning">Cancelar</a>
            </div>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </div>
</body>
</html>
