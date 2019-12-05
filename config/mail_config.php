<?php
include 'form_validation.php';
$form_url = '';//用変更

$month = array(
    '選択してください'=>'','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12'
);
$day = array(
    '選択してください'=>'','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12',
    '13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24',
    '25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31',
);
$pref = array(
''=>'選択してください。','北海道'=>'北海道',
'青森県'=>'青森県','岩手県'=>'岩手県',
'宮城県'=>'宮城県','秋田県'=>'秋田県',
'山形県'=>'山形県','福島県'=>'福島県',
'茨城県'=>'茨城県','栃木県'=>'栃木県',
'群馬県'=>'群馬県','埼玉県'=>'埼玉県',
'千葉県'=>'千葉県','東京都'=>'東京都',
'神奈川県'=>'神奈川県','新潟県'=>'新潟県',
'富山県'=>'富山県','石川県'=>'石川県',
'福井県'=>'福井県','山梨県'=>'山梨県',
'長野県'=>'長野県','岐阜県'=>'岐阜県',
'静岡県'=>'静岡県','愛知県'=>'愛知県',
'三重県'=>'三重県','滋賀県'=>'滋賀県',
'京都府'=>'京都府','大阪府'=>'大阪府',
'兵庫県'=>'兵庫県','奈良県'=>'奈良県',
'和歌山県'=>'和歌山県','鳥取県'=>'鳥取県',
'島根県'=>'島根県','岡山県'=>'岡山県',
'広島県'=>'広島県','山口県'=>'山口県',
'徳島県'=>'徳島県','香川県'=>'香川県',
'愛媛県'=>'愛媛県','高知県'=>'高知県',
'福岡県'=>'福岡県','佐賀県'=>'佐賀県',
'長崎県'=>'長崎県','熊本県'=>'熊本県',
'大分県'=>'大分県','宮崎県'=>'宮崎県',
'鹿児島県'=>'鹿児島県','沖縄県'=>'沖縄県'

);
class form_settings {
    use FormValidation;
    public $post_data;
    public $formstep;
    public $url;
    public function __construct($postdata,$formstep=0){
        global $form_url;
        $this->url = $form_url;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(!empty($postdata) and is_array($postdata)){
                foreach ($postdata as $key => $val):
                    if(!empty($val) and is_array($val)):
                        foreach ($val as $key2 => $val2):
                            $this->post_data[$key] = filter_input(INPUT_POST, $key, FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);
                        endforeach;
                    else:
                        $this->post_data[$key] = filter_input(INPUT_POST, $key);
                    endif;
                endforeach;
            }
            //
            $this->formstep = $formstep;
            $this->formdata_set();
        }
        else {
            if($formstep===0 ){
                
            }else {
                header('Location: ' . $this->url, true , 301);
                exit();
            }

        }
    }
    protected function formdata_set(){
        if($this->formstep===0){
        }
        else if($this->formstep===1) {
            if($_POST['csrf'] === $_SESSION['csrf_token']){
                $this->form_reatrun_box();
                
            }
            else {                
                header('Location: ' . $this->url, true , 301);
               exit();
            }
        }
        else if($this->formstep===3) {
            if($_POST['csrf'] === $_SESSION['csrf_token_thanks']){
                $this->form_reatrun_box();
            }
            else {                
                header('Location: ' . $this->url, true , 301);
                exit();
            }
        }
        else{
            
        }
    }
    private function form_reatrun_box() {
        if(!empty($this->post_data) and is_array($this->post_data)){
            foreach ($this->post_data as $key => $val):
                if(!empty($val) and is_array($val)){
                    foreach ($val as $key2 => $val2){
                        $this->form_data[$key][$key2] = $this->form_datasets($val2);
                    }
                }else {
                    $this->form_data[$key] = $this->form_datasets($val);
                }
            endforeach;
            $this->ValidationCheack();
        }
    }
    private function form_datasets($string = 0) {
        if(!empty($string) and !is_array($string)){
            $string = strip_tags($string);
            $string = preg_replace("/<script.*<\/script>/", "", $string) ;
            $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
            return $string;
        }
    }
    public function form_databack(){
        if(!empty($this->form_data) and is_array($this->form_data)){
            foreach ($this->form_data as $key => $val):
                if(!empty($val) and is_array($val)){//チェックボックスどうかをチェックする。
                    foreach ($val as $key2 => $val2){
                        ?>
                        <input type="hidden" name="<?php echo $key; ?>[<?php echo $key2; ?>]" value="<?php echo $val2; ?>">
                        <?php 
                    }
                }else{//チェックボックス以外。
                    if($key==='csrf'){                        
                    }else{
                        ?>
                            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>">
                        <?php
                    }
                }
            endforeach;
        }
    }
}


class sendmailcl extends form_settings {
    private $mail_user_title;//ユーザーにメールが届いた時の差出人名
    private $mail_addmin_title;
    private $mail_user_header;//ユーザーに届いた際返信する先のアドレス。    
    private $mail_addmin_address;
    private $mail_admin_title;
    private $kyoutuumail_body;
    private $user_mail_body;
    private $admin_mail_body;
    public $sendmail_err;
    public function sendmail_chack() {
        if($this->formstep===3 and $this->post_data['csrf'] === $_SESSION['csrf_token']){
            $this->send_mail_config_setting();
        }else {
            header('Location: ' . $this->url, true , 301);
            exit();            
        }
    }
    private function send_mail_config_setting() {    
        $this->mail_user_title = 'お問い合わせありがとうございます。';//【要変更】ユーザー宛メールの題名
        $this->mail_user_header = "From:会社名<担当者のメールアドレス>";//【要変更】ユーザー宛メール差出人（差出人名・メールアドレス設定）  
        
        $this->mail_admin_title = 'お問い合わせありがとうございます。';//【要変更】管理者宛メールの題名
        $this->mail_addmin_address = array('担当者のメールアドレス','担当者のメールアドレス2');//【要変更】管理人用送り先メールアドレス
        $this->user_mail_body_settings();
        $this->admin_mail_body_settings();
        
        $this->sendmail();
    }
    private function user_mail_body_settings(){
        $this->user_mail_body = 'メールお問い合わせを賜りました。'.PHP_EOL;
        $this->user_mail_body .= 'この度は～～～～～～～～。'.PHP_EOL;
        $this->user_mail_body .= PHP_EOL.PHP_EOL.PHP_EOL;
        $this->user_mail_body .= $this->same_mail_body();
        $this->user_mail_body .= PHP_EOL.PHP_EOL.PHP_EOL;
        $this->user_mail_body .= "----------------------------------------------------------".PHP_EOL;
        $this->user_mail_body .= "会社名を入力しましょう".PHP_EOL;
        $this->user_mail_body .= "会社の住所を記載しましょう。".PHP_EOL;
        $this->user_mail_body .= "会社の電話番号を記載しましょう。".PHP_EOL;
        $this->user_mail_body .= "担当者の名前を記載しましょう。".PHP_EOL;
        $this->user_mail_body .= "担当者のメールアドレス".PHP_EOL;
        $this->user_mail_body .= "----------------------------------------------------------".PHP_EOL;
    }
    private function admin_mail_body_settings(){
        $this->admin_mail_body = 'メールお問い合わせを頂きました。'.PHP_EOL;
        $this->admin_mail_body .= PHP_EOL.PHP_EOL.PHP_EOL;
        $this->admin_mail_body .= $this->same_mail_body();
        $this->admin_mail_body .= PHP_EOL.PHP_EOL.PHP_EOL;
        $this->admin_mail_body .= "----------------------------------------------------------".PHP_EOL;
        $this->admin_mail_body .= "会社名を入力しましょう".PHP_EOL;
        $this->admin_mail_body .= "会社の住所を記載しましょう。".PHP_EOL;
        $this->admin_mail_body .= "会社の電話番号を記載しましょう。".PHP_EOL;
        $this->admin_mail_body .= "担当者の名前を記載しましょう。".PHP_EOL;
        $this->admin_mail_body .= "担当者のメールアドレス".PHP_EOL;
        $this->admin_mail_body .= "----------------------------------------------------------".PHP_EOL;
    }
    private function same_mail_body() {
        $mail_body = PHP_EOL."【お問い合わせ内容】".PHP_EOL;
        if(!empty($this->post_data['name'])):
                $mail_body .= "お名前    　　 ：　". $this->form_data['name']."".PHP_EOL;
        endif;
        if(!empty($this->post_data['email'])):
                $mail_body .= "メールアドレス ：　". $this->form_data['email']."".PHP_EOL;
        endif;
        if(!empty($this->post_data['tel'])):
                $mail_body .= "電話番号    　：　". $this->form_data['tel']."".PHP_EOL;
        endif;
        if(!empty($this->post_data['bukken_name'])):
                $mail_body .= "物件名　    　：　". $this->form_data['bukken_name']."".PHP_EOL;
        endif;  
        if(!empty($this->post_data['bukken_address'])):
                $mail_body .= "物件住所    　：　". $this->form_data['bukken_address']."".PHP_EOL;
        endif;  
        if(!empty($this->post_data['contact'])):
                $mail_body .= "お問い合わせ内容\n". $this->form_data['contact']."".PHP_EOL;
        endif;
        return $mail_body;
    }
   private function sendmail() {
        //ユーザー宛用
        $this->sendmail_err =0;
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        if(mb_send_mail($this->form_data['email'], $this->mail_user_title, $this->user_mail_body, $this->mail_user_header)){
            $this->sendmail_err++;
        }
        //管理者宛
        $admin_mail_header = "From:".$this->form_data['name']."<".$this->post_data['email'].">";
        foreach($this->mail_addmin_address as $key=>$val){
            if(mb_send_mail($val, $this->mail_admin_title, $this->admin_mail_body, $admin_mail_header)){
                $this->sendmail_err++;
            }else{

            }
        }       
        if($this->sendmail_err===0) {
            
        }else {
            
        }
    }
}

?>