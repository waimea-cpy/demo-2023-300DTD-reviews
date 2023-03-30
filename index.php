<?php

    require_once 'common-top.php';

    $sql = 'SELECT games.id, 
                   games.title, 
                   games.publisher, 
                   COUNT(reviews.id) AS reviewCount,
                   AVG(reviews.rating) AS ratingAverage
            FROM games
            LEFT JOIN reviews ON games.id = reviews.game
            GROUP BY games.id
            ORDER BY title ASC';

    $games = getRecords( $sql );

    echo '<section id="game-list" class="columns">';

    foreach( $games as $game ) {
        echo '<a class="card" href="show-game.php?id='.$game['id'].'">';
        echo   '<h3>'.$game['title'].'</h3>';
        echo   '<p>by '.$game['publisher'].'</p>';
        echo   '<p>Rating: '.$stars[ round( $game['ratingAverage'] ) ].'<br>';
        echo   '(from '.$game['reviewCount'].' reviews)</p>';
        echo '</a>';
    }

    echo '</section>';

    require_once 'common-bottom.php';

?>

