
<h2>Тест</h2>

## Задача

# Задача спроектировать и реализовать REST API для клиента SPA-фронта (клиент не разрабатываем)

## Данные аналитики
Организация, для которой мы делаем приложение оказывает услуги на мелкие разовые работы по догвороам заказчикам. 
Заказчиков (потенциальных заказчиков) очень много, и первое что нужно сделать это спискок заказчиков с указанием
заключали ли они договоры. В дальнейшем система будет развиваться, но сейчас надо показать первую страницу.
Заказчик передал нам csv файлы из своей прошлой системы, где указаны их сущности
1. Заказчик-юридическое лицо - записей в файле пара сотен тысяч со своим набором полей (name, mainBankAccount, postAddress, registrationAddress )
2. Заказчик-физическое лицо - записей в файле ок миллиона со своим набором полей (name, surname, patronimic, bankAccount, livingAddress)
3. Договор (в каждом договоре может быть несколько разных услуг, каждый заказчик может иметь много договоров) колонки: number, state, dateStart, dateEnd
4. ТипУслуги (например, уборка офиса, мытье окон, ремонт кондиционера и прочее )


## Дизайнер отрисовал необходимую страницу:

список по всем заказчикам с поиском (по всем трем колонкам) и пагинацией в три колонки:

PS: Данные от заказчика наполнять не надо


# РЕЗУЛЬТАТ

Рабочий вариант доступен по следующим ссылкам

# GET запрос на отображение информации
**(http://test5.agency911.org/api/getlist?searchOnName=w&searchOnContr=w&page=2&onpage=6)**

Обязательные поля: 
- page   - Текущая страница пагинации
- onpage - Количество строк на странице для пагинации

Допустимые значения в запросе GET: 
-	searchOnName  - текст для поиска в в наименовании клиента
-	searchOnContr - текст для поиска среди номеров неоплаченных договоров (2й столбец выборки)


# GET запрос на отображение инфоримации о клиенте
** http://test5.agency911.org/api/client?UID=1 **
Обязательный параметр: 
- UID - Идентификатор пользователя из таблицы cat. Данный идентификатор содержится в ответе на запрос 
отображения полной информации.


# GET запрос на редактирование инфоримации о клиенте
** http://test5.agency911.org/api/clientmod?UID=1&STATUS=FL&name=%27Weissnat,%20Bernhard%20and%20Orn1%27 **
Обязательный параметр: 
- UID - Идентификатор пользователя из таблицы cat. Данный идентификатор содержится в ответе на запрос 
отображения полной информации.
Допустимые параметры
Для физлиц:
- name 
- surname
- patronimic
- BankAccount
- livingAddress

Для юрлиц:
- name 
- mainBankAccount
- postAddress 
- registrationAddress

В ответ на данный запрос возвращается информация о пользователе в обновленном виде