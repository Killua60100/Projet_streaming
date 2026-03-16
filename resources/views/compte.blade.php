<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
        <title>Page de connexion</title>
    </head>
    <body>


        @include('header')


        <div class="row justify-content-center">
            <div class="col-md-6">
                <br>
                <br>
                <div class="card border-danger bg-danger shadow ">
                    <div class="card-header text-center">
                        <h4>Mon compte</h4>
                    </div>
                    <div class="card-body text-center">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&size=80" class="rounded-circle mb-3" alt="photo profil">
                        <h5 class="text-light">{{ Auth::user()->name }}</h5>
                        <p class="text-light">{{ Auth::user()->email }}</p>
                        <br>
                        <div class="text-center">
                            <p><strong>ID :</strong> {{ Auth::user()->id }}</p>
                            <p><strong>Compte créé :</strong> {{ Auth::user()->created_at }}</p>
                        </div>
                        <a href="#" class="btn btn-danger mt-3">
                            Modifier le profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <section class="Favorite-row">
            <h2 class="text-light">Liste des Favoris</h2>
        </section>
        <br>
        <br>
        <br>
        <section class="WatchList-row">
            <h2 class="text-light">A regarder plus tard</h2>
        </section>
        @include('footer')
    </body>
</html>