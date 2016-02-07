# City Department

Міський департамент поліції онлайн надає моливість перегляду злочинів на карті, інформації про управління, відділеня та відділки поліції.

## Ліцензія

Дивіться файл LICENCE

## Налаштування середовища розробки

Для створення середовища розробки вам необхідно встановити наступні програмні продукти:

* [Vagrant](https://www.vagrantup.com/downloads.html)
* [VirtualBox](https://www.virtualbox.org/wiki/Downloads)

Якщо ви користуєтесь Linux чи OSX то також рекомендується встановити Ansible.

Послідовність встановлення необхідних пакетів для Linux:

```
$ sudo apt-get install vagrant
$ sudo apt-get install virtualbox-qt
$ vagrant plugin install vagrant-hostsupdater
```

Встановлення ansible в Linux:

```
$ sudo apt-get install software-properties-common
$ sudo apt-add-repository ppa:ansible/ansible
$ sudo apt-get update
$ sudo apt-get install ansible
$ sudo apt-get install nfs-kernel-server
```

Після встановлення Vagrant потрібно поставити додатково плагін ```vagrant-hostsupdater```. Для цього в поточній директорії запустіть

    vagrant plugin install vagrant-hostsupdater

Після встановлення всіх необхідних пакетів, необхідно ініціалізувати сабмодулі в git репозитарії. Для цього необхідно мати
налаштований ssh-ключ для git. З папки даного проекту, виконайте команду:

```
$ git submodule update --init
```

Примітка: Мені чомусь довелось у файлі ```ansible/roles/overdrive3000.ansible-percona/meta/main.yml```
закоментувати останній рядок:

     #dependecies: []

Причина мені невідома, але помилку видає на той рядок.

Коли всі додатки будуть встановлено запустіть:

    vagrant up

і середовище розробки буде автоматично створено для вас. Доступитись до сервера з кодом можна за адресою: [http://police.local/](http://police.local).

Крім того, після запуску віртуальної машини, необхідно виконати деякі дії на самій віртуальній машині:

Заходимо в термінал віртуальної машини:

```
$ vagrant ssh
```

встановлюємо модуль less для node:

```
vagrant@police:~$ sudo npm install -g less
```

А також ініціалізуємо symfony:

```
vagrant@police:/vagrant$ cd /vagrant
vagrant@police:/vagrant$ composer install
vagrant@police:/vagrant$ app/console cache:clear
vagrant@police:/vagrant$ app/console assets:install web --symlink
vagrant@police:/vagrant$ app/console assetic:dump
```

Ще необхідно змінити права доступу до файлу /etc/mysql/my.cnf Він чогось доступний до запису всім. З віртуалки:

```
vagrant@police:/vagrant$ sudo chmod 644 /etc/mysql/my.cnf
```

Для імпорта даних про злочини, можна тимчасово покласти файл (наприклад tmp2.sql) в папку проекта (вона автоматично
зявиться в папці /vagrant у віртуальній машині. І з віртуальної машини запустити команду імпорту:

```
vagrant@police:/vagrant$ app/console police:crimes:import tmp2.sql
```

Після успішного імпорту, файл tmp2.sql можна видалити.

## Як внести свій вклад?

* Зробіть форк цього репозиторію.
* Зробіть необхідні зміни до коду в окремій гілці логічно назваши її.
* Оформіть пулл реквест до цього репозиторію з описом змін і нововведень, що ви зробили.