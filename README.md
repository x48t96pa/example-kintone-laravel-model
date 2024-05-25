# example-kintone-laravel-model

cybozu.com にて提供されている [kintone REST API](https://cybozudev.zendesk.com/hc/ja/categories/200147600-kintone-API) を Eloquent Modelのような感じで取り扱える(予定) PHPライブラリを目指すリポジトリに向けた実験用  

composer の開発ってどうやるのwな状態なので...ライブラリを開発するためのリポジトリ

## 使用条件 (Use version)

- PHP 8.x+ (TODO:GuzzleHttp使えるを最低限条件にしたいかな、できればEnumも)

## インストール (How to install)
composer で配布できる形を目指したいっすね...

## 使い方 (For example)
```php
use xxx/Kintone/Model

class XXXModel extends Model
{
    // な感じで簡易的に
}

XXXModel::find(1); // → record.json の id検索実行的な
```

## 開発構成 (For develop)
```text
/example-kintone-laravel-model
    ┗ /docker ... example-laravel 向け PHP,WEBサーバーとか Dockerfile置き場
    ┗ docker-compose.yml ... example-laravel 向け Docker Compose
    ┗ /kintone-laravel-model ... composer ライブラリにする 資材置き場
    ┗ /example-laravel ... 上のライブラリを使ったLaravel プロジェクト サンプル
```

## 参考
- [Kintone PHP SDK の形 ゴールにしたい](https://github.com/hissy/kintone-php)
- [Kintone PHP SDK その2 の形 ゴールにしたい](https://github.com/ochi51/cybozu-http)
- [PHP Composer ライブラリ ローカル開発の流れ](https://zenn.dev/temori/articles/qiita-20201208-0c199a041f1f7d09640f#%E3%81%AF%E3%81%98%E3%82%81%E3%81%AB)
- [composer.json ローカルリポジトリを呼び出すの書き方](https://qiita.com/suin/items/d24c2c0d8c221ccbc2f3)
- [composer.json リポジトリ指定について](https://blog.okashoi.net/entry/2021/06/08/071437)

※　composer require "x48t96pa/kintone-laravel-model:*@dev" でないと呼び出せなかったので注意
## 開発用...
ディレクトリ構成

## ライセンス
MITライセンス

## 計画
[目指したいゴールはORCLEのModelのような構成で目指したい](https://github.com/yajra/laravel-oci8/tree/master)
名前：laravel-kintoneにして作っていこう!

1. abstract KintoneModel のクラスだけで完結 バージョン
1. 接続先決定クラスとconfigの対応
1. 条件指定 取得の作成
1. 登録・更新の作成
1. 関数によって、単体取得 APIに通信されるようにする
1. 変数またはクラスによって、別API(ユーザー情報やアプリの設定情報など)に通信されるようにする

### 上記詳細
1. abstract KintoneModel に ::all() 関数を実装(queryとかは使わず)し → records.jsonが取得できる
1. Connectionクラスを作成し 接続先のKintoneの柔軟に対応
1. Query組み込み, records.json 情報取得の where句の自動生成
1. Query?にて records.json API s登録・更新のロジック組み込み
1. ::find() 関数では record.jsonのAPIに通信する どのAPIに通信できるかの拡張
1. ユーザー情報の時 ::all() にて ユーザー一覧.jsonのAPIに通信する どのAPIに通信できるかの拡張（レコード以外）
