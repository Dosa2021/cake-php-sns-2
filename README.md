PHP 7.4.33
cakephp 3.8.13

bin/cake server 

docker-compose up --build
http://localhost:80/

ec2
composer install
docker compose up -d

bin/cake bake migration CreateUsers email:string password:string role:string created:DATETIME modified:DATETIME
bin/cake migrations migrate
bin/cake bake model Users

bin/cake migrations seed

https://qiita.com/jinto/items/fe1da36b65fd6e704338


-------------------------------------------
・db接続、環境変数
https://qiita.com/kaba_farm/items/968e7d167089fcd96190#%E5%BF%85%E8%A6%81%E3%81%AA%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%82%92%E4%BD%9C%E6%88%90

・ec2内のdb設定
https://specially198.com/create-a-lemp-environment-on-aws-ec2-and-install-cakephp/

・エラーハンドリング
https://qiita.com/n-sofue/items/8a3c50a74da214b29772#controller-1

10. ユーザの更新〜
・railsのパーシャル的なやつ
https://blog.ver-1-0.net/2017/01/04/cakephp3-partial/

-------------------------------------------
トラブル

① unknown variable 'default-authentication-plugin=mysql_native_password'
  → docker-composeしたら

  x
  - 3307:3307

  o
  - 3307:3306

②ログイン後、リダイレクトしない。。
  → debugとか仕込んじゃダメ。。。？？？

  -------------------------------------------
TODO

・画像投稿
