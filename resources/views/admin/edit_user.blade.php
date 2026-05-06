@extends('admin.admin')

@section('content')
    <div class="container">
        <h1>Modifier l'utilisateur</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="edit-user-form" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nom</label>
                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
            </div>

            <div class="form-group form-check" style="margin-top: 20px;">
                <input id="change_password" type="checkbox" class="form-check-input">
                <label class="form-check-label" for="change_password">Changer le mot de passe</label>
            </div>

            <div class="form-group">
                <label for="password">Nouveau mot de passe <small>(laisser vide pour ne pas changer)</small></label>
                <input id="password" type="password" name="password" class="form-control" autocomplete="new-password" disabled>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmation du mot de passe <small>(uniquement si vous changez le mot de passe)</small></label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" autocomplete="new-password" disabled>
            </div>

            <div class="form-group form-check">
                <input type="hidden" name="is_admin" value="0">
                <input id="is_admin" type="checkbox" name="is_admin" value="1" class="form-check-input" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_admin">Administrateur</label>
            </div>

            <div class="form-actions" style="display:flex; gap:10px; margin-top:20px;">
                <button type="submit" class="bouton">Enregistrer</button>
                <a href="{{ route('admin.dashboard') }}" class="bouton cancel">Annuler</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const changePassword = document.getElementById('change_password');
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');

            changePassword.addEventListener('change', function () {
                const enabled = changePassword.checked;

                password.disabled = !enabled;
                passwordConfirmation.disabled = !enabled;

                if (!enabled) {
                    password.value = '';
                    passwordConfirmation.value = '';
                }
            });
        });
    </script>
@endsection
