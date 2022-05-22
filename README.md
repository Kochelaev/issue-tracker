# Быстрый старт

#### клонируем проект с git
```shell
git clone git@github.com:Kochelaev/issue-tracker.git
```  

#### переходим в директорию проекта
```shell
cd issue-tracker/
```  

#### Запускаем контейнер
```shell
docker-compose up -d
```  

#### Создаем .env файл
```shell
cp .env.example issue-tracker/.env
```  

#### Устанавливаем необходимые компоненты
```shell
composer install -d issue-tracker/
```  

#### Стартуем миграции
```shell
docker exec issue-tracker-app php vendor/bin/phpmig migrate
```  

миграции также регистритуют двух пользователей: Админимтратора `admin` с паролем `123` и модератора `Василий` с паролем `321` =)  

Приложение доступно по адрессу: http://localhost:8000/  

База данных доступна по порту: 3366 (3306 внутри контейнера).  


# Компоненты  

1. `cartalyst/sentinel` для авторизации пользователей.  
2. `josegonzalez/dotenv` для парсинга .env файла  
3. `davedevelopment/phpmig` для миграций БД.  
5. `smarty/smarty` шаблонизатор.  

# Структура проекта  

## Директории:  
* `app`  - классы приложения  
* `controllers` - контроллеры  
* `models` - модели  
* `public` - является точкой входа в приложение  
* `views` содержит шаблоны smarty  

## Классы  
* `App\Singleton` - абстрактный класс, все наследники которого реалзиуют одноименный паттерн.  
* `App\Database` - наследник класса `Singleton`, предоставляет приложению доступ к БД.  
* `App\Auth` - наследник класса `Singleton`, класс-обертка над компонентом `cartalyst/sentinel`.  
* `App\Route` - маршутизация приложения.  
* `App\Validator` - валидация вводимых пользователями данных, подготовка данных для отправки в БД. (SRP немножко не нарушен).  
* `App\Cookier` - управление Cookie-файлами.  
* `App\Paginator` - генерация кнопок-ссылок для постраничного отображения (да, да, он самодельный =))  
* `Controllers\BaseControlle` - родительский класс для всех контроллеров приложения.  
* `Models\BaseModel` - родитьльский класс для всех моделей приложения.  

