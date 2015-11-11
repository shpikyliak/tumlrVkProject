# Отправка изображений с Tubmlr в групу ВКонтакте


В поле **Type blog name** ввести название блога в Tumblr. 

Например *'komanda'*.

Для получения доступа к отправке изображений в Вконтакте перейдите по ссылке *GET VK access token*. С адресной строки скопируйте **access_token** в поле *Insert access token*
и нажмите **Save**

##Tests
Папка включает в себя **PHPUnit тесты**

## css
bootstrap файлы

##classes

**getCurl** - функция для отправки запроса с помощью *CUrl*

**saveToken** - сохраняет *access token* в **.env** файл

**tubmlrParser** - выводит изображения с tubmlr

**uploadVkImg** - постит изображения на стену Vk.

**Изображения постятся в [групу](https://vk.com/club101646894)**
Можно изменить адрес групы в файле uploadVkImg.php в переменной *$group_id*.

В **.env** файле хранятся пароли от приложения в Tubmlr и access_token для vk
