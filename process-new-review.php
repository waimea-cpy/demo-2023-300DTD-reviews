<?php

    require_once 'common-top.php';

    echo '<section>';

    echo '<h2>Adding New Review...</h2>';

    // Get submitted data
    $game   = $_POST['game'];
    $author = $_POST['author'];
    $title  = $_POST['title'];
    $body   = $_POST['body'];
    $rating = $_POST['rating'];

    // Add new user to the DB
    $sql = 'INSERT INTO reviews (game, author, title, body, rating) 
            VALUES (?, ?, ?, ?, ?)';

    modifyRecords( $sql, 'ssssi', [$game, $author, $title, $body, $rating] );

    // Inform the user of success and head back to home page
    showStatus( 'New review posted successfully', 'success' );

    addRedirect( 2000, 'show-game.php?id='.$game );

    echo '</section>';

    require_once 'common-bottom.php';
?>
    