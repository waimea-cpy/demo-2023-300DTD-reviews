<?php

    require_once 'common-top.php';

    if( !isset( $_GET['id'] ) || empty( $_GET['id'] ) ) showErrorAndDie( 'Missing game ID' );

    $gameID = $_GET['id'];

    $sql = 'SELECT games.id, 
                   games.title, 
                   games.description,
                   games.publisher, 
                   AVG(reviews.rating) AS ratingAverage
            FROM games
            LEFT JOIN reviews ON games.id = reviews.game
            WHERE games.id = ?
            GROUP BY games.id';

    $games = getRecords( $sql, 'i', $gameID );

    if( count( $games ) == 0 ) showErrorAndDie( 'Invalid game ID' );

    $game = $games[0];

    $sql = 'SELECT reviews.title,
                   reviews.body,
                   reviews.date,
                   reviews.rating,
                   users.username 
            FROM reviews
            JOIN users ON reviews.author = users.id
            WHERE game = ?
            ORDER BY date DESC';

    $reviews = getRecords( $sql, 'i', $gameID );

    echo '<section id="game-info">';
    echo   '<header>';
    echo     '<h2>'.$game['title'].'</h2>';
    echo     '<p>by '.$game['publisher'].'</p>';
    echo   '</header>';

    echo   '<p>'.text2paras( $game['description'] ).'</p>';

    echo   '<p>Average Rating: '.$stars[round( $game['ratingAverage'] )].'</p>';

    echo '</section>';


    echo '<section id="game-reviews">';
    echo   '<header>';
    echo     '<h3>Reviews ('.count( $reviews ).')</h3>';
    echo   '</header>';

    if( count( $reviews ) > 0 ) {
        foreach( $reviews as $review ) {
            echo '<div class="review">';
            echo   '<header>';
            echo     '<h4>'.$review['title'].'</h4>';
            echo   '</header>';
            
            echo   '<p>Rating: '.$stars[$review['rating']].'</p>';
            echo   text2paras( $review['body'] );

            echo   '<footer>';
            echo     '<p>Posted by <strong>'.$review['username'].'</strong> ';
            echo     daysFromToday( $review['date'] ).' at '.niceTime( $review['date'] ).'</p>';
            echo   '</footer>';
            echo '</div>';
        }
    }

    echo '</section>';

    if( $loggedIn ) {
        include 'form-new-review.php';
    }

    require_once 'common-bottom.php';

?>

