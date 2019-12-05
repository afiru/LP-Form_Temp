<div class="wapper form_contents">
    <h2 class="t_center form_title_contents">お問い合わせフォーム</h2>
    <table class="margin_wapper_30 form_contents_table">
        <tr>
            <th>
                <span class="title">お名前</span>
                <span class="hissu">必須</span>
            </th>
            <td>
                <?php if(!empty($postdatas->post_data['name'])) {  echo $postdatas->post_data['name']; } ?>
            </td>
        </tr>
        <tr>
            <th>
                <span class="title">メールアドレス</span>
                <span class="hissu">必須</span>
            </th>
            <td>
                <?php if(!empty($postdatas->post_data['email'])) {  echo $postdatas->post_data['email']; } ?>
            </td>
        </tr>
        <tr>
            <th>
                <span class="title">メールアドレス（確認用）</span>
                <span class="hissu">必須</span>
            </th>
            <td>
                <?php if(!empty($postdatas->post_data['re_email'])) {  echo $postdatas->post_data['re_email']; } ?>
            </td>
        </tr>
        <tr>
            <th>
                <span class="title">電話番号</span>
                <span class="hissu">必須</span>
            </th>
            <td>
                <?php if(!empty($postdatas->post_data['tel'])) {  echo $postdatas->post_data['tel']; } ?>
            </td>
        </tr>
        
        <tr>
            <th>
                <span class="title">物件名</span>
            </th>
            <td>
                <?php if(!empty($postdatas->post_data['bukken_name'])) {  echo $postdatas->post_data['bukken_name']; } ?>
            </td>
        </tr>
        
        <tr>
            <th>
                <span class="title">物件住所</span>
            </th>
            <td>
                <?php if(!empty($postdatas->post_data['bukken_address'])) {  echo $postdatas->post_data['bukken_address']; } ?>
            </td>
        </tr>
        
        
        <tr>
            <th>
                <span class="title">お問い合わせ内容</span>
                <span class="hissu">必須</span>
            </th>
            <td>
                <?php if(!empty($postdatas->form_data['contact'])) {  echo nl2br($postdatas->form_data['contact']); } ?>
            </td>
        </tr>
    </table>
</div>
<div class="wapper margin_wapper_30 display_flex_stretch display_row">
    <div class="back_button_wap">
        <form action="index.php" method="post">
            <?php $postdatas->form_databack(); ?>
            <input class="form_submit_button" type="submit" value="入力画面へ戻る">
        </form>
    </div>
    <div class="submit_button_wap">
        <form action="thanks.php" method="post">
            <?php $postdatas->form_databack(); ?>
            <input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf_token_thanks']; ?>">
            <input class="form_submit_button" type="submit" value="送信する">
        </form>
    </div>
</div>