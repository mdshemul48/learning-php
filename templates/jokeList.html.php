<p style="margin-bottom: 20px; font-size: 20px;"><?= $totalJokes ?> jokes have been submitted to the Internet Joke Database.</p>

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



        <form action="/joke/delete" method="post">
            <button type="submit" name="deletebtn" value="<?= $joke['id'] ?>">Delete</button>
        </form>
        <a href="/joke/edit?id=<?= $joke['id'] ?>"><button>Edit</button></a>

        </p>

    </blockquote>
<?php endforeach; ?>