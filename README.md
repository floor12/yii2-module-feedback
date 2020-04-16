# yii2-module-feedback

[![Latest Stable Version](https://poser.pugx.org/floor12/yii2-module-feedback/v/stable)](https://packagist.org/packages/floor12/yii2-module-feedback)
[![Latest Unstable Version](https://poser.pugx.org/floor12/yii2-module-feedback/v/unstable)](https://packagist.org/packages/floor12/yii2-module-feedback)
[![Total Downloads](https://poser.pugx.org/floor12/yii2-module-feedback/downloads)](https://packagist.org/packages/floor12/yii2-module-feedback)
[![License](https://poser.pugx.org/floor12/yii2-module-feedback/license)](https://packagist.org/packages/floor12/yii2-module-feedback)

Модуль для работы с обращениями пользователей на сайте. Из коробки содержит обычную встраевуемую и форму для модального окна.
Возможна конфигурация различных тематик для обращения с отправкой уведомлений о них на разные адреса. 
Администрирование сохранными заявками происходит через отдельный CRUD.


## Установка

### Добавление модуля в проект

Для добавления модуля выполняем команду
```bash
$ composer require floor12/yii2-module-feedback
```
или добавляем в секцию "required" вашего файла composer.json следую строку:
```json
"floor12/yii2-module-feedback": "dev-master"
```

### Выполнение миграций

Для хранения сохраненных обращений спользуется таблица `feedback`. Выполняем миграции:

```bash
$ ./yii migrate --migrationPath=@vendor/floor12/yii2-module-feedback/src/migrations
```

 Для автоматического применения миграций из установленных в проект модулей рекомендую использовать дополнительный компонент, 
например [fishvision/yii2-migrate](https://github.com/fishvision/yii2-migrate).

### Регистрация и конфигурирование модуля

Для дальнейшей работы необходимо зарегистрировать данный и зависимый от него модули в конфиге приложения, в секции `modules`. 
В минимальной конфигурации регистрация модуля выглядит следующим образом:

```php  
'modules' => [
    'modules' => [
        'feedback' => [
            'class' => 'floor12\feedback\Module',
        ],
    ]
    ...
```

При этом `floor12\feedback\Module` имеет дополнительные параметры для конфигурации:

1. `adminRoles
` - массив ролей пользователей, которым доступно управление, по умолчанию содержит `['@']` предоставляя доступ всем авторизованным пользователям;
2. `adminLayout` - алиас для лейаута админского контроллера, по умолчанию `@app/views/layouts/main`;
3. `frontendLayout` - алиас для лейаута фронтенд контроллера 
(исползуется если отображать форму на отдельной странице), по умолчанию `@app/views/layouts/main`;
3. `viewFormModal` - алиас пути к view формы для модального окна, по умолчанию `@vendor/floor12/yii2-module-feedback/src/views
/frontend/_form_modal_bs`;
4. `viewFormEmbedded
` - алиас пути к view формы для встраивания в страницу или показу на отдельной странице, по умолчанию `@vendor/floor12/yii2
-module-feedback/src/views/frontend/_form_embedded`;
5. `viewSuccessModal` - алиас пути к view, отдаваемому в модальное окно при успешной отправки обращения, по умолчанию `@vendor/floor12/yii2-module-feedback/src/views/frontend/_success_modal_bs`;
5. `viewSuccessEmbedded` - алиас пути к view, отдаваемому клиенру при успешной отправки обращения, по умолчанию `@vendor/floor12/yii2-module
5. `emailRequired ` - является ли `email` обязательным полем, по умолчанию `false`;
5. `phoneRequired ` - является ли `phone` обязательным полем, по умолчанию `true`;

### Темы запросов и адреса для уведомлений

Для работы модуля, необходимо задать хотя бы одну конфигурацию через параметры Yii2 приложения. 
Обычно, это можно сделать в файлах `app\config\params.php` или `common\config\params.php`.
В параметры необходимо прописать `no-replyEmail`,`no-replyEmail` и массив `contactForm`. 

Пример конфигурации:

```php
[
    'params'=>[
        'no-replyEmail' => 'no-reply@mcmoscow.ru',
        'no-replyName' => 'Мебельный Центр Москва',
        'contactForm' => [
                [
                    'title' => 'По общим вопросам',
                    'emails' => ['main@example.com', 'main@example.com']
                ],
                [
                    'title' => 'По вопросам аренды',
                    'emails' => ['main@example.com', 'main@example.com']
                ]
            ]
        ]
    ];
```

Использование
-----

После регистрации в приложении административный CRUD по-умолчанию 
доступен по адресу `/feedback/admin/index`, за который 
отвечает `floor12\feedback\controllers\AdminController`

Для обработки пользовательских запросов и рендеринга форм используется
`floor12\feedback\controllers\FrontendController`, который по имеет 
action для работы с формой в модальном окне `/feedback/admin/form-modal` и 
в виде обычной страницы `/feedback/admin/form`. 

Например, размещение кнопки на открытие модального окна с формой может выглядить так:

С использованием Bootstrap Modal и, соответственно, Jquery:
```html
<button onclick="showForm('/feedback/admin/form-modal',0)">Напишите нам письмо</button>
```
Для этого подхода, необходимо зарегистрировать в приложении `floor12\editmodal\EditModalAsset`. 
Для этих же целей можно воспользоваться `floor12\feedback\components\OpenContactModalButtonWidget`.
 
Если вы не хотите и не используете Bootstrap и Jquery, то можно воспользоваться моей ванильной 
имплементацией модального окна. Она прорисует модалное окно и загрузит туда форму, и jquery,
 необходимый для работы базовых валидаций форм Yii2 загрузится уже туда, только если пользователь открывал форму. 
```html
<button onclick="f12editmodal.open('/feedback/admin/form-modal')">Напишите нам письмо</button>
```
Для этого случая, необходимо зарегистрировать в приложении другой бандл:`floor12\editmodal\EditModal2Asset`. 
