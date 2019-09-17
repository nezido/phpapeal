<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,700&display=swap&subset=cyrillic"
          rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/ui/css/theme.css">
    <title>Электронная приемная</title>
</head>
<body>
<nav class="nav">
    <div class="container content">
        <h1>Электронная приемная</h1>
    </div>
</nav>

<div class="container-fluid">
    <div class="table-responsive-lg">
        <table class="table">
            <thead class="thead-light">
                <tr class="table-dark">
                    <th scope="col">Фамилия</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Отчество</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Email</th>
                    <th scope="col">Текст обращения</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (($types?:[]) as $type_key=>$type_name): ?>
                    <tr class="table-secondary"><td colspan="12"><?= ($type_name) ?></td></tr>
                    <?php foreach (($result?:[]) as $res): ?>
                        <?php if ($type_key==$res['type']): ?>
                            <tr>
                                <td><?= ($res['surname']) ?></td>
                                <td><?= ($res['name']) ?></td>
                                <td><?= ($res['last_name']) ?></td>
                                <td><?= ($res['phone']) ?></td>
                                <td><?= ($res['email']) ?></td>
                                <td><?= ($res['apeal_text']) ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>