<?php 
    session_start();
    require_once(dirname(__FILE__) . '/config/mail_config.php');
    $postdatas = new sendmailcl($_POST,3);
    $postdatas->sendmail_chack();
    session_destroy();
    
?>

<?php include 'include/header/header.php'; ?>

<h2 class="t_center">お問い合わせを送信しました。</h2>
<p class="margin_30 wapper">
    メールを送信しました。お問い合わせいただき誠にありがとうございます。<br>
    お問い合わせいただいた内容を確認し、ご返信させていただきます。恐れ入りますが今しばらくお待ちください。
</p>
<div class="wapper margin_60 thanks_button">
    <a href="index.php">トップに戻る</a>
</div>

<?php include 'include/footer/footer.php'; ?>