function submit_function(form) {
    var form = form; //текущая форма

    function formSend(formObject, form) {
        $.ajax({
            type: "POST",
            url: 'test.php',
            dataType: 'json',
            contentType: false,
            processData: false,
            data: formObject,
            success: function() {
                $(form).trigger('reset'); //при успешной отправке сбрасываем форму в дефолтное состояние
                alert('Success');
            }
        });
    };

    function formData_assembly(form) {
        var formSendAll = new FormData(), //создаем объект FormData
            form_arr = $(form).find(':input,select,textarea').serializeArray(), //собираем все данные с формы без файлов
            formdata = {}; //ассациативный массив для хранения данных с формы

        for (var i = 0; i < form_arr.length; i++) {
            if (form_arr[i].value.length > 0) { //перебераем массив с данными формы и проверяем на заполненность
                var current_input = $(form).find('input[name=' + form_arr[i].name +
                    '],select[name=' + form_arr[i].name + '],textarea[name=' + form_arr[i].name + ']'),
                    value_arr = {}; // новые массив с данными каждого поля + заголовок
                var title = $(current_input).attr('data-title'); //заголовок поля
                if ($(current_input).attr('type') != 'hidden') { //проверяем не является ли поле системным
                    value_arr['value'] = form_arr[i].value;
                    value_arr['title'] = title;
                    formdata[form_arr[i].name] = value_arr;
                } else {
                    formSendAll.append(form_arr[i].name, form_arr[i].value); //системные поля пересылаем отдельно от общей формы
                }
            }
        }
        formdata = JSON.stringify(formdata);
        formSendAll.append('formData', formdata); // добавляем все поля в formdata

        // file
        if ($(form).find('input[type=file]').hasClass('js_file_check')) { //проверяем есть ли input type file для пересылки
            var current_input = $(form).find('input[type=file]');
            if ($(current_input).val().length > 0) { //проверяем на заполненность
                $('.js_file_list li').each(function() {
                    var list_file_name = $(this).find('span').text();
                    for (var k = 0; k < $(current_input)[0].files.length; k++) {
                        if (list_file_name == $(current_input)[0].files[k].name) { //сверяем список выбранных файлов для загрузки
                            formSendAll.append($(current_input).attr('name'), $(current_input)[0].files[k]); // добавляем только те что остались в списке
                        }
                    }
                })
            }
        }
        formSend(formSendAll, form);
    }
    formData_assembly(form);
};
//file load
var reader;

function abortRead() {
    reader.abort();
}

function errorHandler(evt) {
    switch (evt.target.error.code) {
        case evt.target.error.NOT_FOUND_ERR:
            alert('File Not Found!');
            break;
        case evt.target.error.NOT_READABLE_ERR:
            alert('File is not readable');
            break;
        case evt.target.error.ABORT_ERR:
            break; // noop
        default:
            alert('An error occurred reading this file.');
    };
}

function handleFileSelect(evt) {
    var thisInput = $(this); //input type file для множественных загрузок
    for (var i = 0; i < thisInput[0].files.length; i++) { //перебираем все загруженные файлы и запускаем обработчик для каждого
        reader_file(thisInput[0].files[i]); //добавляем обработчик для каждого файла
    }
}

function reader_file(file) {
    var reader = new FileReader(),
        fileName = file.name;
    reader.onerror = errorHandler; //функция для обработки ошибок
    $('.js_file_list').append('<li><span>' + fileName + '</span><div class="js_file_remove file_remove"></div><div class="progress-bar js_progress_bar"></div></li>'); //добавляем все новые файлы в список на клиенте
    reader.onabort = function(e) {
        alert('File read cancelled');
    };
    reader.onload = function(e) { //событие успешного окончания загрузки
        //что-нибудь делаем
    }
    reader.onprogress = function(event) { // вывод процентной полосы загрузки
        if (event.lengthComputable) {
            var percent = parseInt(((event.loaded / event.total) * 100), 10);
            $('.js_progress_bar').css('width', percent + '%');
        }
    }
    if (reader.readAsBinaryString === undefined) { // если браузер не поддерживает readAsBinaryString
        reader.readAsBinaryString = function(fileData) {
            var binary = "",
                pt = this,
                reader = new FileReader();
            reader.onload = function(e) {
                var bytes = new Uint8Array(reader.result);
                var length = bytes.byteLength;
                for (var i = 0; i < length; i++) {
                    binary += String.fromCharCode(bytes[i]);
                }
                pt.content = binary;
                $(pt).trigger('onload');
            }
        }
        reader.readAsArrayBuffer(file);
    } else {
        reader.readAsBinaryString(file);
    }
}

function checkFile() {
    var inputs = document.getElementsByClassName('js_file_check');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('change', handleFileSelect, false);
    }
}
checkFile();
$('.js_btn_submit').click(function(e) {
    e.preventDefault();
    var current_form = $(this).closest('form');
    submit_function(current_form);
});
$(document).on('click', '.js_file_remove', function() {
    var list_item = $(this).closest('li');
    $(list_item).remove();
});
