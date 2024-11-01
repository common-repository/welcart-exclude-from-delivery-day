<?php
if (!class_exists('mhWcExcludeDelivery')) {
  

  class mhWcExcludeDelivery{

    public function __construct() {
      $this->_init();
    }

    private function _init() {
      $this->_custom_menu();
      $this->_usces_delivery_after_days();
    }

    public function _custom_menu(){
      add_action('admin_menu',function(){
        add_menu_page('wc exclude delivery custom','配送希望日設定','manage_options', MHWEFD_PLUGIN_BASENAME , array($this,'_wc_exclude_delivery_custom_page') , '',1000);
      });
      
    }

    public function _wc_exclude_delivery_custom_page(){
      include('include/my_custom_page.php');
    }

    public function _usces_delivery_after_days(){
      add_filter( 'usces_delivery_after_days_script', function($delivery_after_days_script){
        $my_option = esc_textarea(get_option('wc-exclude-delivery'));

        $jogai = '';
        if($my_option){
          $my_option = str_replace(array('　'),'',$my_option);
          $jogaiA = explode(" ",$my_option);
          $ji = 0;
          foreach($jogaiA as $j){
            if($ji>0){
              $jogai = $jogai.',';
            }
            $jogai = $jogai.'"'.$j.'"';
            
            $ji++;
          }
        }

        
        return  "
        option += '<option value=\"指定しない\">指定しない</option>';
        var jogai = [".$jogai."];

        for( var i = 0; i < delivery_after_days; i++ ) {
          date_str = date[\"year\"]+\"-\"+date[\"month\"]+\"-\"+date[\"day\"];
          if(!jogai.includes(date_str)){
            if( date_str == selected_delivery_date ) {
              option += '<option value=\"' + date_str + '\" selected>' + date_str + '</option>';
            } else {
              option += '<option value=\"' + date_str + '\">' + date_str + '</option>';
            }
          }
          date = addDate( date[\"year\"], date[\"month\"], date[\"day\"], 1 );
        }
        ";
      });
    }
  }

  $mh_wc_exclude_delivery = new mhWcExcludeDelivery;
}

