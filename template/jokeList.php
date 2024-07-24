<p><?= $totalJokes ?> jokes have been submitted to the Internet Joke Database.</p>

<?php foreach ($jokes as $joke) : ?>
    <blockquote>
        <p>
            <?= htmlspecialchars(
                $joke['joketext'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
            (by <a href="mailto:<?php
                                echo htmlspecialchars(
                                    $joke['email'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>"><?php
                                        echo htmlspecialchars(
                                            $joke['name'],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ); ?></a>)
        <form action="deletejoke.php" method="post">
            <button type="submit" name="deletebtn" value="<?= $joke['id'] ?>">Delete</button>
        </form>
        </p>

    </blockquote>
<?php endforeach; ?>