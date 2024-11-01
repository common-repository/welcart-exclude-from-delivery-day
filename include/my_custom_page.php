<?php
$update_key = false;
if (!empty( $_POST ) && check_admin_referer( 'wefdd_action', '_wpnonce') && current_user_can('manage_options')){
  foreach($_POST as $key => $value){
    if(strpos($key,'wc-') !== false){
      add_option($key);
      
      update_option($key,sanitize_text_field($value));
      $update_key = true;
    }
  }
}
$url = sanitize_url((empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
?>
<div class="my-form wefdd-contents">
  <h1>Welcart 配送希望日除外設定</h1>
  <p>ここはwelcartの配送除外日を設定するオプションページです。</p>
  <?php if($update_key): ?>
  <p class="update-text">更新されました。</p>
  <?php endif; ?>
  <form action="<?php echo esc_url($url) ?>" method="post">
    <?php wp_nonce_field( 'wefdd_action','_wpnonce' ); ?>
    <table class="form-table">
      <tbody>
        <tr>
          <th>配送除外日</th>
          <td>
            <textarea name="wc-exclude-delivery" class="regular-text"><?php echo str_replace(' ',"\n",esc_textarea(get_option('wc-exclude-delivery')));  ?></textarea>
            <p>入力例：2022-12-06</p>
          </td>
        </tr>


        <tr>
          <th>使用方法</th>
          <td>配送希望日から除外したい日付けを入力してください。<br>※複数の日付けを登録する場合は改行で区切ってください。</td>
        </tr>
      </tbody>
    </table>
    <div class="description-box">
      <h2>ご利用前に</h2>
      <p>このプラグインは「<a href="https://www.welcart.com/" target="_blank">Welcart</a>」の機能を拡張するプラグインです。<br>Welcartをインストールしていないサイトは対象外となりますのでご注意ください。</p>
    </div> 
    <p class="submit-button"><input type="submit" class="button button-primary" value="更新"></p>
  </form>
</div>
