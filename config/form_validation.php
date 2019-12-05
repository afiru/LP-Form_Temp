<?php
trait FormValidation {
    public $err;
    private function ValidationCheack() {
        //print_r($this->post_data);
        if(empty($this->post_data['name'])) { $this->err['name'] = '名前は必須項目です。'; }
        
        if(empty($this->post_data['email'])) { 
            $this->err['email_02'] = 'メールアドレスを入力してください。';
        }elseif(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $this->post_data['email'])){
            $this->err['email_02'] = 'メールアドレスを入力してください。';
        }else {
            
        }
        
        if(empty($this->post_data['re_email'])) { 
            $this->err['email_02'] = 'メールアドレス確認用を入力してください。';
        }
        elseif(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $this->post_data['re_email'])){
            $this->err['email_02'] = 'メールアドレス確認用を入力してください。';
        }else {
            
        }
        
        if($this->post_data['email'] === $this->post_data['re_email']){                
        }else {
            $this->err['email_03'] = 'メールアドレスとメールアドレス確認に異なるメールアドレスが入力されています。';
        }
        if (preg_match("/^\d{3}\-\d{4}\-\d{4}$/", $this->post_data['tel']) or preg_match("/^\d{3}\-\d{3}\-\d{4}$/", $this->post_data['tel']) or preg_match("/^\d{4}\-\d{3}\-\d{3}$/", $this->post_data['tel']) or preg_match("/^\d{2}\-\d{4}\-\d{4}$/", $this->post_data['tel']) or preg_match("/^\d{10}$|^\d{11}$/", $this->post_data['tel'])) {             
        }else {
            $this->err['tel'] = '電場番号形式ではありません。'; 
        }
        if(empty($this->post_data['contact'])) { $this->err['contact'] = 'お問い合わせ内容を入力してください。'; }
    }
}


?>