Game-X (Стратегія, RPG)
========================

Інструкція по встановленню
----------------------------------
1) Завантажити з репозиторію

  git clone <rep>

2) Встановити в каталог Composer

  curl -sS https://getcomposer.org/installer | php
  php composer.phar update

3) Створити базу даних "game" та створити її структуру за допомогою команди

  app/console doctrine:schema:update --force

4) Запустити програму гри

  app/console server:start [ip:port]
