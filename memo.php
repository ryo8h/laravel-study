<?php

#laravelメモ

#ルーティングの設定場所
#laravel_sns\routes\web.php

#ビュー
#laravel_sns\resources\views

#DB接続(mysql)
#laravel_sns\.env

#migrateの注意
#mySQLから直接削除せず、ロールバックをする(エラー発生するため)

#mySQLのbooleanはint(1)で 0:false、1:true と表現


#マイグレーション
#php artisan migrate
#エラー発生に繋がるので、mySQLから直接削除せずmigrate:resetを使う

#シード
#php artisan db:seed
#DatabaseSeederが実行されるので、run()内に実行したいシードクラスをcall
#DatabaseSeederを変更したら composer dump-autoloadでオートローダーを再生成する
#外部キーのシード値は以下の例に従って設定できる
#   $user_id = DB::table('users')->pluck('id'); //[1]
#   'user_id' => $user_id[0],  //'1'

#自動生成(ログイン、登録ページの用意)
#php artisan make:auth
#ルーティングは以下のコマンドで確認できる
#php artisan route:list

#ビューへのルートは routes\web.php に記述

#ミドルウェアへのルートは App\Http\Kernel.phpに記述

#routes\web.phpに書かれた Auth::routes() は、以下のファイルで記述
#vendor/laravel/framework/src/Illuminate/Routing/Router.php
#auth()メソッド内

# & を付けると参照渡し(参照受け取り)になる
#$a = 10;
#function add( &$c ){ $c = 100; }
#add( $a );
#echo $a; // 100



TODO:
1, プロフィールページ
2, プロフィール情報の変更

3, アイコンの追加
4, 発言


#loginControllerの__construct()
#   $this->middleware('guest')->except('logout')
#middleware ... Controllerで定義。
#   Controllerの$middlewareに以下の情報を代入
#       呼び出すミドルウェア、引数のoption配列のポインタ(デフォルトは空)
#   返り値は、ControllerMiddlewareOptionsオブジェクト

#except ... ControllerMiddlewareOptionsで定義。
#   exceptに引数の値(logout)がバインドされているかチェック
#       logoutの実行 / func_get_args()(引数の数を返すメソッド)


#シンボリックリンク
#php artisan storage:link
#パブリックディスク(一般公開へのアクセスを許すファイル)はデフォルトでstorage/app/public
#シンボリックリンクを張ることでpublic/storageから上記ファイルへアクセス可能(これでWebからのアクセスを許す)

#ファイルへのURLを生成
#asset('storage/profile_images/example.jpg')

#指定したディスク内にあるデータの存在確認(true/false)
#Storage::disk('public')->exists('profile_images/example.jpg')

#ヘルパ関数 __()
#Lang::get()メソッドのような役割で、ローカリゼーションファイルを用いて翻訳してくれる。

#RegisterControllerのshowRegistrationFormがルーティングされているが、そのようなメソッドは存在しない
#RegistersUsersにトレイト(メソッドやプロパティ群)が記述されている

#書き換え(LaravelでUserモデルを定義していればUsersテーブルを探してくれる)
#DB::table('users')->where()
#User::where()
#上記のUserモデルのようなものをEloquentクラスと呼ぶ

#Eloquentクラス
#composer.jsonファイルでオートロードするように指定した場所にクラスを作る。
#クラス名を複数形のスネークケースにしたテーブル名を探して使用する。(明示しなくてもテーブルにアクセスしている理由)
#idカラムを主キーかつ自動増分するintだと想定している。
#dreated_atとupdated_atのカラムを自動更新する。
#ホワイトリストのfillable()と、ブラックリストのguarded()のどちらかを定義できる
#fillableで設定した属性は複数代入が可能、それ以外は複数代入不可
#guardedで設定した属性は複数代入不可、それ以外は複数代入が可能
#Eloquentクラスはクエリビルダなのでうまく使おう

#adminsテーブルを作成
#→ usersテーブルのauthorカラムを削除(マイグレーション、シードファイルの変更も)
