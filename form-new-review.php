
<section>
    <form method="POST" action="process-new-review.php">

        <header>
            <h2>Add a New Review</h2>
        </header>

        <input name="author" type="hidden" value=<?= $_SESSION['userID'] ?>>

        <input name="game" type="hidden" value=<?= $gameID ?>>

        <label>Title</label>
        <input name="title" type="text" required>

        <label>Review</label>
        <textarea name="body" required></textarea>

        <label>Rating</label>
        <fieldset>
            <label><input type="radio" name="rating" value="1"        >★</label>
            <label><input type="radio" name="rating" value="2"        >★★</label>
            <label><input type="radio" name="rating" value="3"        >★★★</label>
            <label><input type="radio" name="rating" value="4"        >★★★★</label>
            <label><input type="radio" name="rating" value="5"        >★★★★★</label>
        </fieldset>

        <input type="submit" value="Submit Review">
    </form>
</section>
