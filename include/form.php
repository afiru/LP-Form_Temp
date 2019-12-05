<?php
    $_SESSION['csrf_token'] = sha1(session_id());
?>
<div class="wapper form_contents">    
    <form action="confirm.php" method="post">
        <table class="margin_wapper_30 form_contents_table">
            <tr>
                <th>
                    <span class="title">お名前</span>
                    <span class="hissu">必須</span>
                </th>
                <td>
                    <input type="text" name="name" class="" id="" value="<?php if(!empty($postdatas->post_data['name'])) {  echo $postdatas->post_data['name']; } ?>" placeholder="お名前を入力してください">
                    <span class="name_cheack"></span>
                </td>
            </tr>
            <tr>
                <th>
                    <span class="title">メールアドレス</span>
                    <span class="hissu">必須</span>
                </th>
                <td>
                    <input type="email" name="email" class="" id="" value="<?php if(!empty($postdatas->post_data['email'])) {  echo $postdatas->post_data['email']; } ?>" placeholder="Eメールアドレスを入力してください">
                    <span class="name_cheack"></span>
                </td>
            </tr>
            <tr>
                <th>
                    <span class="title">メールアドレス（確認用）</span>
                    <span class="hissu">必須</span>
                </th>
                <td>
                    <input type="email" name="re_email" class="" id="" value="<?php if(!empty($postdatas->post_data['re_email'])) {  echo $postdatas->post_data['re_email']; } ?>" placeholder="上記と同じ　Eメールアドレスを入力してください" >
                    <span class="re_email_cheack"></span>
                </td>
            </tr>
            <tr>
                <th>
                    <span class="title">電話番号</span>
                    <span class="hissu">必須</span>
                </th>
                <td>
                    <input type="tel" name="tel" class="" id="" value="<?php if(!empty($postdatas->post_data['tel'])) {  echo $postdatas->post_data['tel']; } ?>" placeholder="電話番号を半角英数字で入力してください" >
                    <span class="tel_cheack"></span>
                </td>
            </tr>
            
            <tr>
                <th>
                    <span class="title">物件名</span>
                </th>
                <td>
                    <input type="text" name="bukken_name" class="" id="" value="<?php if(!empty($postdatas->post_data['bukken_name'])) {  echo $postdatas->post_data['bukken_name']; } ?>" placeholder="物件名を入力してください。">
                    <span class="name_cheack"></span>
                </td>
            </tr>
            <tr>
                <th>
                    <span class="title">物件住所</span>
                </th>
                <td>
                    <input type="text" name="bukken_address" class="" id="" value="<?php if(!empty($postdatas->post_data['bukken_address'])) {  echo $postdatas->post_data['bukken_address']; } ?>" placeholder="物件の住所を入力してください。">
                    <span class="name_cheack"></span>
                </td>
            </tr>
            <tr>
                <th>
                    <span class="title">お問い合わせ内容</span>
                    <span class="hissu">必須</span>
                </th>
                <td>
                    <textarea name="contact"><?php if(!empty($postdatas->post_data['contact'])) {  echo $postdatas->post_data['contact']; } ?></textarea>
                    <span class="tel_cheack"></span>
                </td>
            </tr>
        </table>
        
        <div class="margin_wapper_30 kinout_text form_contents_read_privacypolicy">
            <?php include 'privacypolicy.php'; ?>
        </div>
        
        <div class="margin_wapper_60 form_submit_button">
            <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input class="form_submit_button" type="submit" value="確認画面へ">
        </div>
    </form>

</div>