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
    <div class="container mt-4">
        <div id="games" class="row"></div>
    </div>


    <!--The footer-->
    <?php include 'include/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>
    <script>
        fetch('include/upcomingGamesAPI.php')
            .then(res => res.json())
            .then(games => {
                const container = document.getElementById('games');

                games.forEach(game => {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 mb-4';

                    const image = game.cover ?
                        "https:" + game.cover.url.replace('t_thumb', 't_cover_big') : '';

                    const date = game.first_release_date ?
                        new Date(game.first_release_date * 1000).toLocaleDateString() : 'TBA';

                    col.innerHTML = `
        <div class="card h-100 shadow-sm">
          ${image ? `<img src="${image}" class="card-img-top">` : ''}
          <div class="card-body">
            <h5 class="card-title">${game.name}</h5>
            <p class="card-text"><strong>Release:</strong> ${date}</p>
          </div>
        </div>
      `;

                    container.appendChild(col);
                });
            });
    </script>

</body>

</html>