<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
</head>
<body>
    <h2>Usuarios</h2>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Verificado</th>
            <th>Acciones</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->verified ? 'Sí' : 'No' }}</td>
            <td>
                @if(!$user->verified)
                <form action="{{ url('/admin/users/' . $user->id . '/verify') }}" method="POST">
                    @csrf
                    <button type="submit">Verificar</button>
                </form>
                @endif
                <button onclick="confirmDelete({{ $user->id }})">Eliminar</button>
                <form id="delete-form-{{ $user->id }}" action="{{ url('/admin/users/' . $user->id) }}" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <script>
        function confirmDelete(userId) {
            if (confirm("¿Eliminar usuario?")) {
                document.getElementById("delete-form-" + userId).submit();
            }
        }
    </script>
</body>
</html>
