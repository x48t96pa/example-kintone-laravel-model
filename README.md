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

## ライセンス
MITライセンス