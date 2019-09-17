<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
<div class="container content">
    <div class="row">
        <form enctype="multipart/form-data" name="main_form" class="w-100 apeal-form" method="post" action="<?= ($BASE) ?>/appeal/create">
            <div class="form-group">
                <label for="apeal-type">Тип обращения</label>
                <select class="form-control" name="apeal-type">
                    <?php foreach (($types?:[]) as $key=>$type): ?>
                        <option value="<?= ($key) ?>"><?= ($type) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="surname">Фамилия</label>
                <input class="form-control" type="text" name="surname" placeholder="Иванов">
            </div>
            <div class="form-group">
                <label for="name">Имя</label>
                <input class="form-control" type="text" name="name" placeholder="Иван">
            </div>

            <div class="form-group">
                <label for="last-name">Отчество</label>
                <input class="form-control" type="text" name="last-name" placeholder="Иванович">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" placeholder="ivanov@gmail.com">
            </div>

            <div class="form-group">
                <label for="last-name">Телефон</label>
                <input type="text" class="form-control bfh-phone" name="phone"
                       data-format="+7 (ddd) ddd-dd-dd" placeholder="+7 (999) 999-99-99">
            </div>

            <div class="form-group">
                <label for="text-apeal">Текст сообщения</label>
                <textarea class="form-control" name="text-apeal" rows="3"></textarea>
            </div>

            <ul class="js_file_list file-list">
            </ul>
            <div class="form-group">
                <div class="file-block">
                    <div class="form-group">
                        <label class="label">
                            <i class="fa fa-paperclip" aria-hidden="true"></i>
                            <span class="title">Прикрепить файл</span>
                            <input class="input-file js_file_check" type="file" name="file[]" id="userfile" multiple="">
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary submit-btn">Написать сообщение</button>
        </form>
    </div>
</div>
<script src="https://use.fontawesome.com/d1be4d6855.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="/ui/js/bootstrap-formhelpers-phone.js"></script>
<script src="/ui/js/page.js"></script>
</body>
</html>