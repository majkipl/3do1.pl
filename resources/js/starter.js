import $ from 'jquery';

(function ($) {
    $.fn.matchMaxHeight = function () {
        const items = $(this);
        $(items).attr('style', '');
        $(items).css({});
        let max = 0;
        for (let i = 0; i < items.length; i++) {
            max = max < $(items[i]).height() ? $(items[i]).height() : max;

        }
        $(items).css({'display': 'block', 'height': '' + max + 'px'});
    }
})(jQuery);

$(window).on("load", () => {
    starter.main.init();
});

$(window).on("resize", () => {
});

$(window).scroll(() => {
});

const starter = {
    _var: {
        error: [], sorted: [], question: 0, answers: [], ts_s: 0, ts_e: 0,
    },

    main: {
        init: function () {
            starter.datepicker.init();

            starter.main.onClick();
            starter.main.onChange();
            starter.main.onSubmit();

            starter.owl.init();

            starter.quiz.init();
        },

        onClick: function () {
            $(document).on('click', '#form .submit', function () {
                $('#form form#save').submit();
                return false;
            });

            $(document).on("click", ".superoption-1 button.superoption-button", function () {
                const $main_prize = $("input[name=main_prize]");

                $(this).toggleClass("superoption-open");

                if ($(this).hasClass("superoption-open")) {
                    $(this).html("rezygnuję z gry o nagrodę główną");
                    $(this).parent().next().show();
                    $main_prize.val(1);
                } else {
                    $(this).html("chcę wygrać nagrodę główną");
                    $(this).parent().next().hide();
                    $main_prize.val("");
                }
            });

            $(document).on("click", ".superoption-2 button.superoption-button", function () {
                const $week_prize = $("input[name=week_prize]");

                $(this).toggleClass("superoption-open");

                if ($(this).hasClass("superoption-open")) {
                    $(this).html("rezygnuję z gry o nagrodę tygodnia");
                    $(this).parent().next().show();
                    $week_prize.val(1);
                } else {
                    $(this).html("Walczę o nagrodę tygodnia");
                    $(this).parent().next().hide();
                    $week_prize.val("");
                }
            });

            $(document).on("click", "button.button-uploads", function () {
                $(this).closest('.field').find("input[type=file]").trigger("click");
            });

            $(document).on("click", ".play-button, .replay-button", function () {
                const now = new Date();
                starter._var.ts_s = now.getTime();

                $(this.dataset.open).slideDown();
                $(this.dataset.close).slideUp();
                $(this.dataset.toggle).slideToggle();
                $(this.dataset.show).fadeIn();
                $(this.dataset.hide).fadeOut();
            });

            $(document).on('click', '#kontakt a.send', function () {
                $(this).closest('form').submit();
                return false;
            });
        },

        onChange: function () {
            $(document).on('change', '.input, .textarea, .checkbox, .file', function (event) {
                const item = $(this);
                const name = $(this).attr('name');
                const valid = starter.form.validate(item, event);

                if (valid !== true) {
                    $(`.error-${name}`).text(valid).closest('.field').addClass('has-error');
                    starter._var.error[name] = valid;
                } else {
                    $(`.error-${name}`).text('').closest('.field').removeClass('has-error');
                    delete starter._var.error[name];

                    if (item.hasClass('upload-file')) {
                        const fileUpload = item[0].files[0];
                        const fieldId = item.attr('id');
                        const errorDiv = $(`.error-${fieldId}`);

                        errorDiv.text('');

                        if (fileUpload) {
                            let reader = new FileReader();

                            reader.onload = function (event) {
                                if (item.hasClass('upload-image')) {
                                    $(`#${fieldId}_thumb`).attr('src', event.target.result).parent().removeClass('hidden').next().addClass('hidden');
                                }

                                if (item.hasClass('upload-audio')) {
                                    const field = $(`#${fieldId}_tag`);
                                    field[0].src = URL.createObjectURL(item[0].files[0]);
                                    field.closest('.field').find('button').addClass('hidden');
                                }
                            }
                            reader.readAsDataURL(fileUpload);
                        }
                    }
                }
            });

            $(document).on('dp.change', '#birthday', function (event) {
                const item = $(this);
                const name = $(this).attr('name');
                const valid = starter.form.validate(item, event);

                if (valid !== true) {
                    $(`.error-${name}`).text(valid).closest('.field').addClass('has-error');
                    starter._var.error[name] = valid;
                } else {
                    $(`.error-${name}`).text('').closest('.field').removeClass('has-error');
                    delete starter._var.error[name];
                }
            });
        },

        onSubmit: function () {
            $(document).on('submit', '#formContact form', function () {

                $('.input, .textarea, .checkbox, .file').trigger('change');

                console.log(starter._var.error);

                if (Object.keys(starter._var.error).length === 0) {

                    const fields = starter.form.getFields($(this).closest('form'));
                    const url = $(this).closest('form').attr('action');

                    axios({
                        method: 'post', url: url, headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }, data: fields,
                    }).then(function (response) {
                        $('#contact h3').html(response.data.results.message);
                        $('#contact .form').hide();
                    }).catch(function (error) {
                        $(`.error-post`).text('');

                        if (error.response) {
                            Object.keys(error.response.data.errors).map((item) => {
                                $(`.error-${item}`).text(error.response.data.errors[item][0]);
                            });
                        } else if (error.request) {
                            console.log(error.request);
                        } else {
                            console.log('Error', error.message);
                        }
                    });

                } else {
                    $('.error-post').text('');
                    for (let key in starter._var.error) {
                        if (starter._var.error.hasOwnProperty(key)) {
                            let value = starter._var.error[key];
                            $('.error-' + key).text(value).closest('.field').addClass('has-error');
                        }
                    }
                }

                return false;
            });

            $(document).on('submit', '#form form', function () {
                $('.input, .textarea, .checkbox, .file').trigger('change');
                $('#birthday').trigger('dp.change');

                console.log(starter._var.error);

                if (Object.keys(starter._var.error).length === 0) {
                    const fields = starter.form.getFields($(this).closest('form'));

                    const url = $(this).closest('form').attr('action');
                    const formData = new FormData();

                    for (const field in fields) {
                        formData.append(field, fields[field]);
                    }

                    axios({
                        method: 'post', url: url, headers: {
                            'content-type': 'multipart/form-data',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }, data: formData,
                    }).then(function (response) {
                        window.location = response.data.results.url;
                    }).catch(function (error) {
                        $(`.error-post`).text('');
                        if (error.response) {
                            Object.keys(error.response.data.errors).map((item) => {
                                $(`.error-${item}`).text(error.response.data.errors[item][0]);
                            });
                        } else if (error.request) {
                            console.log(error.request);
                        } else {
                            console.log('Error', error.message);
                        }
                    });
                } else {
                    $('.error-post').text('');
                    for (let key in starter._var.error) {
                        if (starter._var.error.hasOwnProperty(key)) {
                            let value = starter._var.error[key];
                            $('.error-' + key).text(value);
                        }
                    }
                }

                return false;
            });
        },
    },

    form: {
        getFields: function ($form) {
            const inputs = $form.find('.input');
            const textareas = $form.find('.textarea');
            const checkboxes = $form.find('.checkbox');
            const files = $form.find('.file');
            const fields = {};

            $.each(inputs, function (index, item) {
                fields[$(item).attr('name')] = $(item).val();
            });

            $.each(textareas, function (index, item) {
                fields[$(item).attr('name')] = $(item).val();
            });

            $.each(checkboxes, function (index, item) {
                if ($(item).prop('checked')) {
                    fields[$(item).attr('name')] = $(item).val();
                }
            });

            $.each(files, function (index, item) {
                if (item.files[0]) {
                    fields[$(item).attr('name')] = item.files[0];
                }
            })

            fields['_token'] = $form.find('input[name=_token]').val();

            return fields;
        },

        validate: function (item, event) {
            const value = item.val().trim();
            const name = item.attr('name');
            const isMainPrize = $('#main_prize').val() ? 1 : 0;
            const isWeekPrize = $('#week_prize').val() ? 1 : 0;

            switch (name) {
                case 'firstname':
                    return event.type === 'change' ? starter.form.validator.isName(value, 'Imię') : true;
                case 'lastname':
                    return event.type === 'change' ? starter.form.validator.isName(value, 'Nazwisko') : true;
                case 'email':
                    return event.type === 'change' ? starter.form.validator.isEmail(value, 'Adres e-mail') : true;
                case 'phone':
                    return event.type === 'change' ? starter.form.validator.isPhone(value, 'Telefon') : true;
                case 'shop':
                    return event.type === 'change' ? starter.form.validator.isShop(value, 'Sklep') : true;
                case 'product_code':
                    return event.type === 'change' ? starter.form.validator.isProductCode(value, 'Kod kreskowy') : true;
                case 'whence':
                    return event.type === 'change' ? starter.form.validator.isWhence(value, 'Skąd wiesz o promocji') : true;
                case 'legal_1':
                case 'legal_2':
                case 'legal_3':
                case 'legal_4':
                case 'legal_7':
                    return event.type === 'change' ? starter.form.validator.isLegal(item) : true;
                case 'img_receipt':
                    return event.type === 'change' ? starter.form.validator.isFile(item, 'Zdjęcie paragonu') : true;
                case 'competition_title':
                    return event.type === 'change' && isMainPrize ? starter.form.validator.isName(value, 'Tytuł') : true;
                case 'competition_audio':
                    return event.type === 'change' && isMainPrize ? starter.form.validator.isFileAudio(item, 'Nagranie') : true;
                case 'timer':
                    return event.type === 'change' && isWeekPrize ? starter.form.validator.isTime(value) : true;
                case 'response':
                    return event.type === 'change' && isWeekPrize ? starter.form.validator.isAnswers(value) : true;
                case 'correct':
                    return event.type === 'change' && isWeekPrize ? starter.form.validator.isCorrect(value) : true;
                case 'birthday':
                    return event.type === 'dp' && event.namespace === 'change' ? starter.form.validator.isBirthday(value, 'Data urodzenia') : true;
                case 'name':
                    return event.type === 'change' ? starter.form.validator.isName(value, 'Imię') : true;
                case 'subject':
                    return event.type === 'change' ? starter.form.validator.isName(value, 'Tytuł wiadomości') : true;
                case 'message':
                    return event.type === 'change' ? starter.form.validator.isMessage(value, 'Treść wiadomości') : true;
                default:
                    return true;
            }
        },

        validator: {
            isName: (value, name) => {
                if (value === "") {
                    return `Pole ${name} jest wymagane.`;
                } else if (value.length < 3 || value.length > 128) {
                    return `Pole ${name} musi mieć od 3 do 128 znaków.`;
                } else if (!/^[\p{L}\s-]+$/u.test(value)) {
                    return `Pole ${name} może zawierać tylko litery.`;
                } else {
                    return true;
                }
            },
            isTime: (value) => {
                if (value === "") {
                    return `Musisz rozwiązać QUIZ i zgłosić wynik do konkursu.`;
                } else if (!/^\d+$/u.test(value)) {
                    return `Coś poszło nie tak. Spróbuj ponownie.`;
                } else {
                    return true;
                }
            },
            isAnswers: (value) => {
                if (value === "") {
                    return `Musisz rozwiązać QUIZ i zgłosić wynik do konkursu.`;
                } else {
                    return true;
                }
            },
            isCorrect: (value) => {
                if (value === "") {
                    return `Musisz rozwiązać QUIZ i zgłosić wynik do konkursu.`;
                } else if (value.length < 1 || value.length > 2) {
                    return `Coś poszło nie tak. Spróbuj ponownie.`;
                } else if (!/^\d+$/u.test(value)) {
                    return `Coś poszło nie tak. Spróbuj ponownie.`;
                } else {
                    return true;
                }
            },
            isShop: (value, name) => {
                if (value === "") {
                    return `Pole ${name} jest wymagane.`;
                } else if (value.length < 3 || value.length > 128) {
                    return `Pole ${name} musi mieć od 3 do 128 znaków.`;
                } else {
                    return true;
                }
            },
            isProductCode: (value, name) => {
                if (value === "") {
                    return `Pole ${name} jest wymagane.`;
                } else if (!(value.length === 8 || value.length === 13 || value.length === 14)) {
                    return `Pole ${name} ma błędny format.`;
                } else if (!/^\d+$/u.test(value)) {
                    return `Pole ${name} może zawierać tylko cyfry.`;
                } else {
                    return true;
                }
            },
            isWhence: (value, name) => {
                if (value === "") {
                    return `Pole ${name} jest wymagane.`;
                } else if (isNaN(value) || parseInt(value) < 1) {
                    return 'Wybierz opcje.';
                } else {
                    return true;
                }
            },
            isEmail: (value, name) => {
                if (value === "") {
                    return `Pole ${name} jest wymagane.`;
                } else if (value.length > 255) {
                    return `Pole ${name} może mieć maksymalnie 255 znaków.`;
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                    return 'Wprowadź poprawny adres email.';
                } else {
                    return true;
                }
            },
            isPhone: (value, name) => {
                if (value === "") {
                    return `Pole ${name} jest wymagane.`;
                } else if (!/^\+48(\s)?([1-9]\d{8}|[1-9]\d{2}\s\d{3}\s\d{3}|[1-9]\d{1}\s\d{3}\s\d{2}\s\d{2}|[1-9]\d{1}\s\d{2}\s\d{3}\s\d{2}|[1-9]\d{1}\s\d{2}\s\d{2}\s\d{3}|[1-9]\d{1}\s\d{4}\s\d{2}|[1-9]\d{2}\s\d{2}\s\d{2}\s\d{2}|[1-9]\d{2}\s\d{3}\s\d{2}|[1-9]\d{2}\s\d{4})$/.test(value)) {
                    return 'Wprowadź poprawny numer telefonu.';
                } else {
                    return true;
                }
            },
            isBirthday: (value, name) => {
                if (value === "") {
                    return `Pole ${name} jest wymagane.`;
                } else {
                    return true;
                }
            },
            isLegal: (item) => {
                if (item.val() === "") {
                    return `Pole jest wymagane.`;
                } else if (!item.prop('checked')) {
                    return `Pole jest wymagane.`;
                } else {
                    return true;
                }
            },
            isMessage: (value, name) => {
                if (value === "") {
                    return `Pole ${name} jest wymagane.`;
                } else if (value.length < 3 || value.length > 4096) {
                    return `Pole ${name} musi mieć od 3 do 4096 znaków.`;
                } else {
                    return true;
                }
            },
            isFile: (file, name) => {
                const extension = file[0]?.files[0]?.name.split('.').pop().toLowerCase();
                if (file[0].files.length === 0) {
                    return `Pole ${name} jest wymagane.`;
                } else if (file[0].files[0].size > 4 * 1024 * 1024) {
                    return `Rozmiar pliku nie może przekraczać 4 MB`;
                } else if (['jpg', 'jpeg', 'png'].indexOf(extension) === -1) {
                    return `Można wybrać tylko pliki graficzne JPG, JPEG lub PNG`;
                } else {
                    return true;
                }
            },
            isFileAudio: (file, name) => {
                const extension = file[0]?.files[0]?.name.split('.').pop().toLowerCase();
                if (file[0].files.length === 0) {
                    return `Pole ${name} jest wymagane.`;
                } else if (file[0].files[0].size > 2 * 1024 * 1024) {
                    return `Rozmiar pliku nie może przekraczać 2 MB`;
                } else if (['mp3'].indexOf(extension) === -1) {
                    return `Można wybrać tylko pliki audio MP3`;
                } else {
                    return true;
                }
            },
        },
    },

    datepicker: {
        init: function () {
            if ($('input#birthday').length) {
                $('#birthday').datetimepicker({
                    format: 'DD-MM-YYYY', inline: false, locale: 'pl',
                });
                $('input#firstname').focus();
            }
        }
    },

    quiz: {
        init: function () {
            if ($(".form-form").length) {
                starter.quiz.onClick();
                starter.quiz.getQuestions();
            }
        },

        onClick: function () {
            $(document).on("click", ".report-button", function () {
                $(this.dataset.open).slideDown();
                $(this.dataset.close).slideUp();
                $(this.dataset.toggle).slideToggle();
                $(this.dataset.show).fadeIn();
                $(this.dataset.hide).fadeOut();

                $('.error-timer').text('');
            });

            $(document).on("click", ".return-button", function () {
                starter.quiz.getQuestions();

                starter._var.question = 0;
                starter._var.answers = [];

                starter.quiz.showQuestion(starter._var.question);
            });

            $(document).on("click", ".answer", function () {
                const superOptionQuiz = $(".superoption-quiz");
                const superOptionEnd = $(".superoption-end");

                starter._var.answers[starter._var.sorted[starter._var.question].id] = $(this).data("id");
                starter._var.question++;

                if (starter._var.question < starter._var.sorted.length) {
                    // CONTINUE QUIZ
                    superOptionQuiz.fadeOut(250, () => starter.quiz.showQuestion(starter._var.question));
                    superOptionQuiz.fadeIn(250);
                } else {
                    // END QUIZ
                    starter._var.question = 0;

                    superOptionQuiz.slideToggle(500);
                    superOptionEnd.slideToggle(500);

                    const now = new Date();
                    starter._var.ts_e = now.getTime();

                    const microSecondsDiff = Math.abs(starter._var.ts_e - starter._var.ts_s);

                    $(".superoption-end .end-box #timer").val(microSecondsDiff);
                    $(".superoption-end .end-box #response").val(starter._var.answers.toString());
                    starter.quiz.getCorrectAnswers();
                }
            });
        },

        getQuestions: function () {
            axios.get('/api/quiz')
                .then(function (response) {
                    starter.quiz.initQuiz(response.data.rows);
                })
                .catch(function (error) {
                    console.error(error);
                });
        },

        initQuiz: function (quiz) {
            starter._var.sorted = quiz;
            starter._var.question = 0;
            starter._var.answers = [];

            starter.quiz.showQuestion(starter._var.question);
        },

        showQuestion: function (question) {
            $(".question")
                .data("id", starter._var.sorted[question].id)
                .html(starter._var.sorted[question].name);
            $(".answer-1")
                .data("id", '1')
                .html(starter._var.sorted[question].answer_1);
            $(".answer-2")
                .data("id", '2')
                .html(starter._var.sorted[question].answer_2);
            $(".answer-3")
                .data("id", '3')
                .html(starter._var.sorted[question].answer_3);
        },

        getCorrectAnswers: function () {
            console.log(starter._var.answers);
            axios.post('/api/quiz/correct', {
                answers: starter._var.answers,
            })
                .then(function (response) {
                    console.log(response.data);

                    if (response.data.success) {
                        $("#superoption-end .show-success").show();
                        $("#superoption-end .superoption-text-score span.correct").text(response.data.correct);
                        $("#superoption-end .superoption-text-score span.total").text(response.data.total);
                        $("#superoption-end .end-box #correct").val(response.data.correct);
                    } else {
                        $("#superoption-end .show-error").text(response.data.message).show();
                    }
                })
                .catch(function (error) {
                    console.error(error);

                    $("#superoption-end .show-error").text("Błąd połączenia. Przepraszamy").show();
                });
        },
    },

    owl: {
        init: function () {
            $(".owl-carousel").owlCarousel({
                margin: 30,
                loop: true,
                autoplay: true,
                autoplayTimeout: 15000,
                nav: true,
                navText: ['<img src="/images/svg/home/prev.svg" alt="prev" />', '<img src="/images/svg/home/next.svg" alt="next" />',],
                dots: false,
                responsive: {
                    0: {
                        items: 1,
                    }, 768: {
                        items: 2,
                    }, 992: {
                        items: 3,
                    },
                },
                onInitialized: starter.owl.callback,
                onResized: starter.owl.callback,
                onTranslated: starter.owl.callback,
            });
        },

        callback: () => {
            $('.product-head').matchMaxHeight();
            $('.product-lead').matchMaxHeight();
        }
    }
}

