PHP 7.4.33
cakephp 3.8.13

bin/cake server 

docker-compose up --build
http://localhost:80/

ec2
composer install
docker compose up -d

-------------------------------------------
・db接続、環境変数
https://qiita.com/kaba_farm/items/968e7d167089fcd96190#%E5%BF%85%E8%A6%81%E3%81%AA%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%82%92%E4%BD%9C%E6%88%90

-------------------------------------------
トラブル

① unknown variable 'default-authentication-plugin=mysql_native_password'
  → docker-composeしたら

  x
  - 3307:3307

  o
  - 3307:3306