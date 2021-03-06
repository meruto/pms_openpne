opLikePlugin概要
======================
「いいね！」機能を追加します。

「いいね！」をクリックするといいね！が付きます。  
自分のつけた「いいね！」は「いいね！を取り消す」をクリックすることで取り消すことができます。  

スマートフォンにも対応しています。


スクリーンショット
------
<img src="https://raw.github.com/ichikawatatsuya/opLikePlugin/gh-pages/images/001.png" height=200/>
<img src="https://raw.github.com/ichikawatatsuya/opLikePlugin/gh-pages/images/002.png" height=200/>
<img src="https://raw.github.com/ichikawatatsuya/opLikePlugin/gh-pages/images/003.png" height=200/>
<img src="https://raw.github.com/ichikawatatsuya/opLikePlugin/gh-pages/images/004.png" height=200/>
<img src="https://raw.github.com/ichikawatatsuya/opLikePlugin/gh-pages/images/005.png" height=200/>
<img src="https://raw.github.com/ichikawatatsuya/opLikePlugin/gh-pages/images/006.png" height=200/>
<img src="https://raw.github.com/ichikawatatsuya/opLikePlugin/gh-pages/images/007.png" height=200/>

対応プラグイン
-------------
opTimelinePlugin  
opDiaryPlugin  
opCommunityTopicPlugin  
  
注意
----
ver1.0.5以前ではmigrateを２回以上行うとエラーが発生する状態でした。  
var1.1.0以降ではそのエラーを避けるためにDB構造を変更し、migrateスクリプトを削除致しました。  
以上のことからver1.0.5とver1.1.0の互換性は無く、migrateコマンドでの移行は出来ません。  
申し訳ありません。  
  
消すことの出来ないデータがあり、移行が必要な場合はmysqldump等で退避し手動で入れなおして下さい。  


インストール方法
----------------
**「いいね！」プラグラインのダウンロード**  
symfonyコマンドを使って、直接DLします。

    cd path/to/OpenPNE
    ./symfony opPlugin:install opLikePlugin -r 1.1.1


**「いいね！」に対応したプラグインのダウンロード**  

    cd path/to/OpenPNE  
    ./symfony opPlugin:install opCommunityTopicPlugin -r 1.1.0  
    ./symfony opPlugin:install opDiaryPlugin -r 1.5.0  
    ./symfony opPlugin:install opTimelinePlugin -r 1.1.0  

**OpnePNE本体側Bootstrapの変更・画像の差し替え**

    rm 'OpenPNE ディレクトリ'/web/img/*
    cp 'OpenPNE ディレクトリ'/plugins/opLikePlugin/web/img/* 'OpenPNE ディレクトリ'/web/img/


**CSSの編集**
 ‘OpenPNE ディレクトリ'/web/css/bootstrap.cssを開き、以下の3行を追加

    .icon-thumbs-up {
      background-position: -96px -144px;
    }


**プラグインのインストール**

    ./symfony openpne:migrate


**アセット**

    ./symfony plugin:publish-assets
    

動作環境
--------
OpnePNE3.8.0以上  
    
  
更新履歴
--------

 * 2013/01/28 Ver.0.0.5  iPhoneでいいね！が押せないのを修正。
 * 2012/12/28 Ver.0.0.4  schema.ymlを変更、migrateでエラーを出さないようDB構造を変更。
 * 2012/11/16 Ver.0.0.3  opDiaryPlugin及び、opCommunityTopicPluginに対応。 
 * 2012/11/16 Ver.0.0.2  opNicePlugin → opLikePlugin に名称変更 
 * 2012/11/08 Ver.0.0.1 「いいね！」機能を追加 


  
要望・フィードバック
----------

https://github.com/ichikawatatsuya/opLikePlugin/issues

