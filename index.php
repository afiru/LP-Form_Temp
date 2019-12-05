<?php
    session_start();
    require_once(dirname(__FILE__) . '/config/mail_config.php');
    $postdatas = new form_settings($_POST,0);
    

?>
<?php include 'include/header/header.php'; ?>
<!--コンテンツ-->

<h2 class="t_center form_title_contents">お問い合わせフォーム</h2>
<p class="margin_30 wapper">
    下記フォームに必要事項を入力後、「入力内容を確認する」ボタンをクリックして下さい。<br>
    なお、お問い合わせの内容によっては、ご返答が遅れる場合がございますが、ご了承下さい。<br>
    資料請求を御希望のお客様は、備考欄にご希望の物件名をご記入下さい。<br>
    資料の郵送をご希望のお客様は、ご住所もご記入下さい。※必須は必須項目です。必ずご入力をお願いいたします。
</p>
<?php include 'include/form.php'; ?>
<!--コンテンツ-->
<?php include 'include/footer/footer.php'; ?>