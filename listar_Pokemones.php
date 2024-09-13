<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pokémones</title>
    <style>
        .pokemon-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            text-align: center;
            width: 150px;
            display: inline-block;
        }
        .pokemon-card img {
            width: 100px;
            height: 100px;
        }
        .pokemon-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>
</head>
<body>
    <h1>Lista de Pokémones</h1>
    <div class="pokemon-container">
        <?php
         // Aumentar el tiempo máximo de ejecución
         set_time_limit(300);
        // Función para realizar una solicitud cURL y devolver el contenido
        function fetch_url($url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Tiempo máximo de espera en segundos
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error: ' . curl_error($ch);
                $response = false;
            }
            curl_close($ch);
            return $response;
        }

        // URL de la API de Pokémon
        $apiUrl = 'https://pokeapi.co/api/v2/pokemon?limit=350';

        // Obtener los datos de la API
        $response = fetch_url($apiUrl);
        if ($response !== false) {
            $pokemons = json_decode($response, true)['results'];

            // Iterar sobre cada Pokémon y mostrar su tarjeta
            foreach ($pokemons as $pokemon) {
                // Obtener detalles de cada Pokémon
                $pokemonDetails = fetch_url($pokemon['url']);
                if ($pokemonDetails !== false) {
                    $pokemonData = json_decode($pokemonDetails, true);

                    // Obtener la URL de la imagen
                    $imageUrl = $pokemonData['sprites']['front_default'];
                    $name = ucfirst($pokemon['name']);

                    echo "<div class='pokemon-card'>";
                    echo "<img src='{$imageUrl}' alt='{$name}'>";
                    echo "<h3>{$name}</h3>";
                    echo "</div>";
                }
            }
        }
        ?>
    </div>
</body>
</html>
