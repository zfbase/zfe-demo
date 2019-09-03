# ZFE Demo

Чтобы (пере)поднять окружение, используя docker-compose:
```bash
./tools/start.sh
```

Чтобы начать работать осталось установить зависимости:
```bash
docker-compose exec phpfpm composer install --prefer-source --no-interaction --no-plugins --no-scripts
docker-compose exec phpfpm npm install --only=production --no-audit
docker-compose exec tests composer install --prefer-source --no-interaction --no-plugins --no-scripts
```

Чтобы построить ассеты делаем:
```bash
docker-compose exec phpfpm npm run build
```

Чтобы прогнать приемочные тесты:
```bash
./tools/test.sh
```

**Прогон тестов удаляет все данные в data!**