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
            </tr>
        <?php endforeach ?>
    </tbody>
</table>