<?php
    session_start();
    require_once(dirname(__FILE__) . '/config/mail_config.php');
    $postdatas = new form_settings($_POST,1);
    if (!isset($_SESSION['csrf_token_thanks'])) {
        $_SESSION['csrf_token_thanks'] = sha1(session_id());
    }
?>
<?php include 'include/header/header.php'; ?>
<!--コンテンツ-->
<?php if(empty($postdatas->err)):  ?>
    <?php include 'include/confirm.php'; $_SESSION['csrf_token'] = array(); ?>
<?php else: //エラーがあった場合 ?>
    <h2 class="t_center form_title_contents">お問い合わせフォーム</h2>
    <ul class="margin_30 form_err color_ff0000">
    <?php if(is_array($postdatas->err)): foreach ($postdatas->err as $key=> $val): ?>    
        <li><?php echo $val; ?></li>    
    <?php endforeach; endif; ?>
    </ul>
    <?php include 'include/form.php'; ?>
<?php endif; ?>
<?php include 'include/footer/footer.php'; ?>