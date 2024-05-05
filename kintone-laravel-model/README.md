# kintone-laravel-model

cybozu.com にて提供されている [kintone REST API](https://cybozudev.zendesk.com/hc/ja/categories/200147600-kintone-API) を Eloquent Modelのような感じで取り扱える(予定) PHPライブラリを目指すリポジトリに向けた実験用  

## 必要条件 (Use version)

PHP 8.x+ (TODO:GuzzleHttp使えるを最低限条件にしたいかな、できればEnumも)

## インストール (How to install)

### コンポーザー
がゴールにしたいっす

## 使い方 (For example)

```php
use xxx/Kintone/Model

class XXXModel extends Model
{
    // な感じで簡易的に
}

XXXModel::find(1); // → record.json の id検索実行的な
```

## ライセンス

MITライセンス