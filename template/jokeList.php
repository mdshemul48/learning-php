<table>

    <thead>
        <tr>
            <td>ID</td>
            <td>Joke Text</td>
            <td>Joke Date</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?= $row["id"] ?></td>
                <td><?= $row["joketext"] ?></td>
                <td><?= $row["jokedate"] ?></td>
                <td>
                    <form action="deletejoke.php" method="post">
                        <button type="submit" name="deletebtn" value="<?= $row["id"] ?>">delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>