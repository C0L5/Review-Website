<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/master.css">
</head>


<body class="d-flex flex-column">
    <!-- Navigation Bar -->
    <?php include 'include/navigationBar.php' ?>
    <div class="container-fluid d-flex justify-content-center mt-2">
        <h2>Upcoming Games 2026</h2>
    </div>
    <div class="container mt-4">
        <div id="games" class="row"></div>
    </div>


    <!--The footer-->
    <?php include 'include/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>
    <script>
        async function loadGames() {
            const container = document.getElementById('games');

            // 1. Show loading message
            container.innerHTML = `<div class="text-center my-4">
                                    <div class="spinner-border" role="status"></div>
                                     <p>Loading games...</p>
                                    </div>`;

            try {
                const res = await fetch('include/upcomingGamesAPI.php');
                const games = await res.json();

                // 2. Clear loading message
                container.innerHTML = '';

                games.forEach(game => {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 mb-4';

                    const image = game.cover ? "https:" + game.cover.url.replace('t_thumb', 't_cover_big') : '';

                    const date = game.first_release_date ? new Date(game.first_release_date * 1000).toLocaleDateString('en-AU') : 'TBA';

                    col.innerHTML = `<div class="card h-100 shadow-sm">
                                    ${image ? `<img src="${image}" class="card-img-top">` : ''}
                                    <div class="card-body">
                                        <h5 class="card-title">${game.name}</h5>
                                        <p class="card-text">Release Date: ${date}</p>
                                    </div>
                                    </div>`;

                    container.appendChild(col);
                });

            } catch (err) {
                container.innerHTML = '<p style="color:red;">Failed to load games.</p>';
                console.error(err);
            }
        }

        loadGames();
    </script>

</body>

</html>