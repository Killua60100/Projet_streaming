<?php include(base_path('config/get_api.php')); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>HYPER - Streaming</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="body1">

    @include('header')


    <section>
        <div style ="margin-top: 500px; margin-left: 100px;">
            <h1 style ="font-size: 100px">San Andreas</h1>
            <p>Alors qu'un séisme vient de frapper, un pilote d'hélicoptère et sa future ex-femme doivent sauver leur fille avant que la terre se mette à trembler</p>
            <div class="buttons">
                <button class="bouton">regarder maintenant</button>
                <button class="bouton">rajouter aux favoris</button>
            </div>
        </div>
    </section>


    <main style ="margin-top: 350px;">


<section class="movies">

    <section class="movie-row">
        <h2>Latest Movies</h2>
        <button class="scroll-left" data-target="latest">&lt;</button>
        <div class="movie-grid" id="latest">
            <?php afficherFilms("latest"); ?>
        </div>
        <button class="scroll-right" data-target="latest">&gt;</button>
    </section>

    <section class="movie-row">
        <h2>Films d'action</h2>
        <button class="scroll-left" data-target="action">&lt;</button>
        <div class="movie-grid" id="action">
            <?php afficherFilms("action"); ?>
        </div>
        <button class="scroll-right" data-target="action">&gt;</button>
    </section>

    <section class="movie-row">
        <h2>Films d'horreur</h2>
        <button class="scroll-left" data-target="horror">&lt;</button>
        <div class="movie-grid" id="horror">
            <?php afficherFilms("horror"); ?>
        </div>
        <button class="scroll-right" data-target="horror">&gt;</button>
    </section>

    <section class="movie-row">
        <h2>Films de comédie</h2>
        <button class="scroll-left" data-target="comedy">&lt;</button>
        <div class="movie-grid" id="comedy">
            <?php afficherFilms("comedy"); ?>
        </div>
        <button class="scroll-right" data-target="comedy">&gt;</button>
    </section>

    <section class="movie-row">
        <h2>Films populaires</h2>
        <button class="scroll-left" data-target="popular">&lt;</button>
        <div class="movie-grid" id="popular">
            <?php afficherFilms("popular"); ?>
        </div>
        <button class="scroll-right" data-target="popular">&gt;</button>
    </section>

</section>

    @include('footer')

    <!-- Modal -->
    <div id="movieModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="movieDetails">
                <!-- Movie details will be loaded here -->
            </div>
        </div>
    </div>


    <script>
        function showMovieDetails(element) {
            var imdbid = element.getAttribute('data-imdbid');
            fetch('/movie/' + imdbid)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('HTTP error ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    var details = document.getElementById('movieDetails');
                    var poster = data.Poster !== 'N/A' ? data.Poster : 'https://via.placeholder.com/300x450';
                    details.innerHTML = `
                    <div class="movie-content">
                        <img src="${poster}" alt="${data.Title}" style="width: 300px; border-radius: 8px;">

                        <div class="movie-info">

                            <h1>${data.Title} (${data.Year})</h1>
                            <p><strong>Genre :</strong> ${data.Genre}</p>
                            <p><strong>Auteur :</strong> ${data.Director}</p>
                            <p><strong>Acteur :</strong> ${data.Actors}</p>
                            <p><strong>description :</strong> ${data.Plot}</p>

                            <div style="margin-top: 30%;">

                            <button class="bouton" onclick="likeMovie('${imdbid}')">Liker</button>
                            <button class="bouton" onclick="watch('${imdbid}')">Regarder maintenant</button>

                            </div>
                        </div>
                        </div>
                        
                        {{-- Commentaires Section (commenté)
                        <div id="comments-section-${imdbid}" style="margin-top: 30px; border-top: 1px solid #ddd; padding-top: 20px;">
                            <h3>Commentaires</h3>
                            
                            @if(Auth::check())
                            <div id="comment-form-${imdbid}" style="margin-bottom: 20px;">
                                <textarea id="comment-text-${imdbid}" placeholder="Écrivez votre commentaire..." style="width: 100%; height: 50px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; color: white; background-color: #222;"></textarea>
                                <button onclick="submitComment('${imdbid}')" style="margin-top: 10px; padding: 10px 20px; background-color: #e50914; color: white; border: none; border-radius: 4px; cursor: pointer;">Envoyer</button>
                            </div>
                            @else
                            <p><a href="{{ route('connexion') }}">Connectez-vous</a> pour laisser un commentaire.</p>
                            @endif
                            
                            <div id="comments-list-${imdbid}"></div>
                        </div>
                        --}}
                    `;
                    document.getElementById('movieModal').style.display = 'block';
                        // setTimeout(() => loadComments(imdbid), 100);
                })
                .catch(error => {
                    console.error('Error fetching movie details:', error);
                });
        }
        
        /*
 
        */ // 

        function likeMovie(imdbid) {
            fetch('/like-movie', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ imdbid: imdbid })
            })
            .then(response => response.json().then(data => ({ status: response.status, data })))
            .then(({ status, data }) => {
                if (status === 401) {
                    window.location.href = '{{ route('connexion') }}';
                    return;
                }

                if (status !== 200 || data.status !== 'ok') {
                    console.error('Like error:', data.message || data);
                }
            })
            .catch(error => {
                console.error('Network error while liking movie:', error);
            });
        }

        document.querySelector('.close').onclick = function() {
            document.getElementById('movieModal').style.display = 'none';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('movieModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        // Gestion des boutons de navigation
        document.querySelectorAll('.scroll-left').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const grid = document.getElementById(targetId);
                grid.scrollBy({ left: -300, behavior: 'smooth' });
            });
        });

        document.querySelectorAll('.scroll-right').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const grid = document.getElementById(targetId);
                grid.scrollBy({ left: 300, behavior: 'smooth' });
            });
        });
    </script>

</body>
</html>


