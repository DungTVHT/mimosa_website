<?php

/*Disable edit code & plugin */
define( 'DISALLOW_FILE_EDIT', true );
define('DISALLOW_FILE_MODS',true);

add_filter('xmlrpc_enabled', '__return_false');
add_filter('wp_headers', 'wptangtoc_remove_x_pingback');
add_filter('pings_open', '__return_false', 9999);
add_filter('pre_update_option_enable_xmlrpc', '__return_false');
add_filter('pre_option_enable_xmlrpc', '__return_zero');
function wptangtoc_remove_x_pingback($headers) {
unset($headers['X-Pingback'], $headers['x-pingback']);
return $headers;
}

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );

// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );

//Ẩn các panel không cần thiết
 add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets()
{
     global $wp_meta_boxes;

     // Right Now - Comments, Posts, Pages at a glance
     unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);

     // Recent Comments
     unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);

     // Incoming Links
     unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);

     // Plugins - Popular, New and Recently updated WordPress Plugins
     unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

     // WordPress Development Blog Feed
     unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);

     // Other WordPress News Feed
     unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

     // Quick Press Form
     unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);

     // Recent Drafts List
     unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
}



//Ẩn Welcome Panel:
add_action( 'load-index.php', 'hide_welcome_panel' );

function hide_welcome_panel() {
    $user_id = get_current_user_id();

    if ( 1 == get_user_meta( $user_id, 'show_welcome_panel', true ) )
        update_user_meta( $user_id, 'show_welcome_panel', 0 );
}





//Xóa logo wordpress
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );

function remove_wp_logo( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'wp-logo' );
}



//Ẩn cập nhật woo

//Remove WooCommerce's annoying update message
remove_action( 'admin_notices', 'woothemes_updater_notice' );

// REMOVE THE WORDPRESS UPDATE NOTIFICATION FOR ALL USERS EXCEPT ADMIN
   global $user_login;
   get_currentuserinfo();
   if (!current_user_can('update_plugins'))
   {
        // checks to see if current user can update plugins
           add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
           add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
   }

//xoa mã bưu điện thanh toán
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
     unset($fields['billing']['billing_postcode']);
     unset($fields['billing']['billing_country']);
     unset($fields['billing']['billing_address_2']);
     unset($fields['billing']['billing_company']);
     
    
     return $fields;
}
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

class Auto_Save_Images{
 
    function __construct(){     
        
        add_filter( 'content_save_pre',array($this,'post_save_images') ); 
    }
    
    function post_save_images( $content ){
        if( ($_POST['save'] || $_POST['publish'] )){
            set_time_limit(240);
            global $post;
            $post_id=$post->ID;
            $preg=preg_match_all('/<img.*?src="(.*?)"/',stripslashes($content),$matches);
            if($preg){
                foreach($matches[1] as $image_url){
                    if(empty($image_url)) continue;
                    $pos=strpos($image_url,$_SERVER['HTTP_HOST']);
                    if($pos===false){
                        $res=$this->save_images($image_url,$post_id);
                        $replace=$res['url'];
                        $content=str_replace($image_url,$replace,$content);
                    }
                }
            }
        }
        remove_filter( 'content_save_pre', array( $this, 'post_save_images' ) );
        return $content;
    }
    
    function save_images($image_url,$post_id){
        $file=file_get_contents($image_url);
        $post = get_post($post_id);
        $posttitle = $post->post_title;
        $postname = sanitize_title($posttitle);
        $im_name = "$postname-$post_id.jpg";
        $res=wp_upload_bits($im_name,'',$file);
        $this->insert_attachment($res['file'],$post_id);
        return $res;
    }
    
    function insert_attachment($file,$id){
        $dirs=wp_upload_dir();
        $filetype=wp_check_filetype($file);
        $attachment=array(
            'guid'=>$dirs['baseurl'].'/'._wp_relative_upload_path($file),
            'post_mime_type'=>$filetype['type'],
            'post_title'=>preg_replace('/\.[^.]+$/','',basename($file)),
            'post_content'=>'',
            'post_status'=>'inherit'
        );
        $attach_id=wp_insert_attachment($attachment,$file,$id);
        $attach_data=wp_generate_attachment_metadata($attach_id,$file);
        wp_update_attachment_metadata($attach_id,$attach_data);
        return $attach_id;
    }
}
new Auto_Save_Images();

function register_my_menu() {
  register_nav_menu('product-menu',__( 'Menu Danh mục' ));
}
add_action( 'init', 'register_my_menu' );


function Gia_giam() {
    global $product;
    if( $product->is_on_sale() ) {
        return $product->get_sale_price();
    }else{
        return 0;
    }
   
}
function Gia_goc() {
    global $product;
    if( $product->is_on_sale() ) {
        return $product->get_regular_price();
    }else{
        return $product->get_regular_price();
    }
   
}
// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'flatsome_enqueue_scripts_styles' );
function flatsome_enqueue_scripts_styles() {
wp_enqueue_style( 'dashicons' );
wp_enqueue_style( 'flatsome-ionicons', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
}





function devvn_remove_slug( $post_link, $post ) {
    if ( !in_array( get_post_type($post), array( 'product' ) ) || 'publish' != $post->post_status ) {
        return $post_link;
    }
    if('product' == $post->post_type){
        $post_link = str_replace( '/san-pham/', '/', $post_link ); //Thay cua-hang bằng slug hiện tại của bạn
    }else{
        $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    }
    return $post_link;
}
add_filter( 'post_type_link', 'devvn_remove_slug', 10, 2 );
/*Sửa lỗi 404 sau khi đã remove slug product hoặc cua-hang*/
function devvn_woo_product_rewrite_rules($flash = false) {
    global $wp_post_types, $wpdb;
    $siteLink = esc_url(home_url('/'));
    foreach ($wp_post_types as $type=>$custom_post) {
        if($type == 'product'){
            if ($custom_post->_builtin == false) {
                $querystr = "SELECT {$wpdb->posts}.post_name, {$wpdb->posts}.ID
                            FROM {$wpdb->posts} 
                            WHERE {$wpdb->posts}.post_status = 'publish' 
                            AND {$wpdb->posts}.post_type = '{$type}'";
                $posts = $wpdb->get_results($querystr, OBJECT);
                foreach ($posts as $post) {
                    $current_slug = get_permalink($post->ID);
                    $base_product = str_replace($siteLink,'',$current_slug);
                    add_rewrite_rule($base_product.'?$', "index.php?{$custom_post->query_var}={$post->post_name}", 'top');
                }
            }
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_action('init', 'devvn_woo_product_rewrite_rules');
/*Fix lỗi khi tạo sản phẩm mới bị 404*/
function devvn_woo_new_product_post_save($post_id){
    global $wp_post_types;
    $post_type = get_post_type($post_id);
    foreach ($wp_post_types as $type=>$custom_post) {
        if ($custom_post->_builtin == false && $type == $post_type) {
            devvn_woo_product_rewrite_rules(true);
        }
    }
}
add_action('wp_insert_post', 'devvn_woo_new_product_post_save');

  

add_filter( 'term_link', 'devvn_product_cat_permalink', 10, 3 );
function devvn_product_cat_permalink( $url, $term, $taxonomy ){
    switch ($taxonomy):
        case 'product_cat':
            $taxonomy_slug = 'danh-muc'; //Thay bằng slug hiện tại của bạn. Mặc định là product-category
            if(strpos($url, $taxonomy_slug) === FALSE) break;
            $url = str_replace('/' . $taxonomy_slug, '', $url);
            break;
    endswitch;
    return $url;
}
// Add our custom product cat rewrite rules
function devvn_product_category_rewrite_rules($flash = false) {
    $terms = get_terms( array(
        'taxonomy' => 'product_cat',
        'post_type' => 'product',
        'hide_empty' => false,
    ));
    if($terms && !is_wp_error($terms)){
        $siteurl = esc_url(home_url('/'));
        foreach ($terms as $term){
            $term_slug = $term->slug;
            $baseterm = str_replace($siteurl,'',get_term_link($term->term_id,'product_cat'));
            add_rewrite_rule($baseterm.'?$','index.php?product_cat='.$term_slug,'top');
            add_rewrite_rule($baseterm.'page/([0-9]{1,})/?$', 'index.php?product_cat='.$term_slug.'&paged=$matches[1]','top');
            add_rewrite_rule($baseterm.'(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?product_cat='.$term_slug.'&feed=$matches[1]','top');
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_action('init', 'devvn_product_category_rewrite_rules');
/*Sửa lỗi khi tạo mới taxomony bị 404*/
add_action( 'create_term', 'devvn_new_product_cat_edit_success', 10, 2 );
function devvn_new_product_cat_edit_success( $term_id, $taxonomy ) {
    devvn_product_category_rewrite_rules(true);
}




//Ẩn cập nhật woo

//Remove WooCommerce's annoying update message
remove_action( 'admin_notices', 'woothemes_updater_notice' );

// REMOVE THE WORDPRESS UPDATE NOTIFICATION FOR ALL USERS EXCEPT ADMIN
   global $user_login;
   get_currentuserinfo();
   if (!current_user_can('update_plugins'))
   {
        // checks to see if current user can update plugins
           add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
           add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
   }


// Custom Dashboard
function my_custom_dashboard() {
    $screen = get_current_screen();
    if( $screen->base == 'dashboard' ) {
        include 'admin/dashboard-panel.php';
    }
}
add_action('admin_notices', 'my_custom_dashboard');

// Thay doi duong dan logo admin
function wpc_url_login(){
return "http://webkhoinghiep.net/"; // duong dan vao website cua ban
}
add_filter('login_headerurl', 'wpc_url_login');
// Thay doi logo admin wordpress
function login_css() {
wp_enqueue_style( 'login_css', get_stylesheet_directory_uri() . '/login.css' ); // duong dan den file css moi
}
add_action('login_head', 'login_css');


add_action('woocommerce_shop_loop_item_title','thong_tin_them_sp');

function thong_tin_them_sp(){

    $loai = get_field('loai_san_pham');
    if( $loai == "Tour du lịch"){
            $ngay_khoi_hanh=get_field('ngay_khoi_hanh');
            $thoi_gian=get_field('thoi_gian');
        $lich_trinh=get_field('lich_trinh');
        $di_chuyen=get_field('di_chuyen');
            ?>
            
            <?php

}elseif($loai == "Khách sạn"){
    $dia_chi=get_field('dia_chi');
    $sosao=get_field('so_sao');
    $an_sang=get_field('an_sang');
    $wifi=get_field('wifi');
}
?>
<div class="row row-tien">
<div class="large-12">
    <?php
    global $product; 
$gia=$product->get_price();
        $giagiam= gia_giam();
        $giagoc=gia_goc();
        if ( $giagiam != 0){


        ?>
        

    
        <p class="gia-giam gia-overlay"><span class="tien"><?php echo number_format(gia_giam()); ?></span><span> đồng</span></p>

<?php
}else{
        if ( $giagoc != 0){

?>
        <p class="gia-giam gia-overlay"><span class="tien"><?php echo number_format(gia_goc()); ?></span><span> đồng</span></p>
        <?php

        }else{
            ?>
            <p class="gia-giam gia-overlay"><span class="tien"><?php echo number_format($gia); ?></span><span> đồng</span></p>
          
            <?php
        }
}
?>


    <a href="<?php echo get_the_permalink(); ?>" class="xem-them-ux-product">Chi tiết</a>
</div> 
</div>
<?php
if( $loai == "Tour du lịch"){
    ?>

                               <p class="p-thoi-gian"><i class="fa fa-clock-o" aria-hidden="true"></i>Thời gian: <?php echo $thoi_gian; ?></p>
                                  <p class="p-thoi-gian">  <i class="fa fa-car" aria-hidden="true"></i>Vận chuyển: <?php echo  $di_chuyen; ?></p>
                             
                                  

                                        <?php
                                    }elseif($loai == "Khách sạn"){

?>
        <p class="p-dia-chi"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $dia_chi; ?></p>
                                <ul class="so-sao">
<?php 
if($sosao=="1 sao"){
    ?>
    <div class="star">
                                                        <span class="active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                </div>


<?php
}elseif($sosao=="2 sao"){

?>
<div class="star">
                                                             <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                </div>
<?php
}elseif($sosao=="3 sao"){
?>
<div class="star">
          <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                </div>
<?php
}elseif($sosao=="4 sao"){

?>
<div class="star">
          <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="in-active">★</span>
                                                </div>

<?php
}else{
?>
<div class="star">
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                </div>


<?php
}
?>

</ul>
<?php
}
?>

<?php
}

add_action( 'flatsome_custom_single_product_1', 'thongtin_them_sidebar', 16  );
function thongtin_them_sidebar(){

    $loai = get_field('loai_san_pham');
    if( $loai == "Tour du lịch"){
        $ngay_khoi_hanh=get_field('ngay_khoi_hanh');
        $thoi_gian=get_field('thoi_gian');
        $lich_trinh=get_field('lich_trinh');
        $di_chuyen=get_field('di_chuyen');

    ?>
    <div class="tour row">
            <div class="large-8 small-12">
        <div class="row row-phong">
            <div class="large-4 small-6">
            <p>Ngày khởi hành</p>
            
            </div>
            <div class="large-8 small-6">
                    <p><?php echo $ngay_khoi_hanh;?></p>
            
            </div>

        </div>
            <div class="row row-phong">
            <div class="large-4 small-6">
        
            <p>Thời gian</p>
        
                
            </div>
            <div class="large-8 small-6">
                    
            <p><?php echo $thoi_gian;?></p>
            
            </div>

        </div>
            <div class="row row-phong">
            <div class="large-4 small-6">
        
            <p>Lịch trình</p>
        
                
            </div>
            <div class="large-8 small-6">
            
            <p><?php echo $lich_trinh;?></p>
        
            </div>

        </div>
            <div class="row row-phong">
            <div class="large-4 small-6">
        
            <p>Vận chuyển</p>
                
            </div>
            <div class="large-8 small-6">

            <p><?php echo $di_chuyen;?></p>
            </div>

        </div>
            


        </div>
        <div class="large-4">
    <?php
                    $giagiam= gia_giam();
        $giagoc=gia_goc();
        if ( $giagiam != 0){


        ?>
        

    <p class="gia-goc"><?php echo number_format(gia_goc()); ?><span> đồng</span></p>
        <p class="gia-giam"><span class="tien"><?php echo number_format(gia_giam()); ?></span><span> đồng</span></p>

<?php
}else{
        if ( $giagoc != 0){

?>
        <p class="gia-giam"><span class="tien"><?php echo number_format(gia_goc()); ?></span><span> đồng</span></p>

<?php

        }
}

?>
<a href="#spu-111" class="a-dat-phong">Đặt Tour</a>


        </div>

    </div>
    <?php
}else{
    $dia_chi=get_field('dia_chi');
    $sosao=get_field('so_sao');
    $an_sang=get_field('an_sang');
    $wifi=get_field('wifi');

    ?>
<div class="tour row">
            <div class="large-8 small-12">
        <div class="row row-phong">
            <div class="large-4 small-6">
            <p>Địa chỉ</p>
            
                
            </div>
            <div class="large-8 small-6">
                    <p><?php echo $dia_chi?></p>
            
            </div>

        </div>
            <div class="row row-phong">
            <div class="large-4 small-6">
            <p>Tiêu chuẩn</p>
            
                
            </div>
            <div class="large-8 small-6">
                    <ul class="so-sao">
<?php 
if($sosao=="1 sao"){
    ?>
    <div class="star">
                                                        <span class="active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                </div>


<?php
}elseif($sosao=="2 sao"){

?>
<div class="star">
                                                             <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                </div>
<?php
}elseif($sosao=="3 sao"){
?>
<div class="star">
          <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                </div>
<?php
}elseif($sosao=="4 sao"){

?>
<div class="star">
          <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="in-active">★</span>
                                                </div>

<?php
}else{
?>
<div class="star">
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                </div>


<?php
}
?>

</ul>
            
            </div>

        </div>
    
<div class="row row-phong">
            <div class="large-4 small-6">
            <p>Ăn sáng miễn phí</p>
            
                
            </div>
            <div class="large-8 small-6">
                    <p><?php echo $an_sang?></p>
            
            </div>

        </div>
        <div class="row row-phong">
            <div class="large-4 small-6">
            <p>Wifi miễn phí</p>
            
                
            </div>
            <div class="large-8 small-6">
                    <p><?php echo $wifi?></p>
            
            </div>

        </div>




        </div>
        <div class="large-4">

        <?php
                    $giagiam= gia_giam();
        $giagoc=gia_goc();
        if ( $giagiam != 0){


        ?>
        

    <p class="gia-goc"><?php echo number_format(gia_goc()); ?><span> đồng</span></p>
        <p class="gia-giam"><span class="tien"><?php echo number_format(gia_giam()); ?></span><span> đồng</span></p>

<?php
}else{
        if ( $giagoc != 0){

?>
        <p class="gia-giam"><span class="tien"><?php echo number_format(gia_goc()); ?></span><span> đồng</span></p>

<?php

        }
}
?>
<a href="#spu-268" class="a-dat-phong">Đặt Phòng</a>


        </div>

    </div>

    <?php
}
}
add_action( 'flatsome_custom_single_product_2', 'thongtin_them_sidebar2', 16  );
function thongtin_them_sidebar2(){
     $loai = get_field('loai_san_pham');
         $ngay_khoi_hanh=get_field('ngay_khoi_hanh');
        $thoi_gian=get_field('thoi_gian');
        $lich_trinh=get_field('lich_trinh');
        $di_chuyen=get_field('di_chuyen');

           $dia_chi=get_field('dia_chi');
    $sosao=get_field('so_sao');
    $an_sang=get_field('an_sang');
    $wifi=get_field('wifi');
?>
   <div class="form-tu-van">
    <?php 
        if($loai== "Tour du lịch"){
        echo "<h3>Thông tin Tour</h3>";
        }elseif($loai== "Khách sạn"){
      echo "<h3>Thông tin khách sạn</h3>";
        }

       
        if($loai== "Tour du lịch"){


        ?>
    
        <div class="clearfix"></div>
            <div class="row lich-dang-ky">
            <div class="large-6 small-6">
                    <p>Thời gian</p>    
            </div>
            <div class="large-6 small-6">
            <p><?php echo $thoi_gian;?></p>
            </div>

        </div>
        <div class="clearfix"></div>
            <div class="row lich-dang-ky">
            <div class="large-6 small-6">
            <p>Lịch trình</p>
                
            </div>
            <div class="large-6 small-6">

            <p><?php echo $lich_trinh;?></p>
            </div>

        </div>
        <div class="clearfix"></div>
            <div class="row lich-dang-ky">
            <div class="large-6 small-6">

            <p>Vận chuyển</p>
                
            </div>
            <div class="large-6 small-6">

            <p><?php echo $di_chuyen;?></p>
            </div>

        </div>
        <div class="clearfix"></div>
        <?php
            }else{
                ?>

    <div class="row row-phong">
            <div class="large-6 small-6 ">
            <p>Địa chỉ</p>
            
                
            </div>
            <div class="large-6 small-6">
                    <p><?php echo $dia_chi?></p>
            
            </div>

        </div>
            <div class="row row-phong ">
            <div class="large-6 small-6">
            <p>Tiêu chuẩn</p>
            
                
            </div>
            <div class="large-6 small-6">
                    <ul class="so-sao">
<?php 
if($sosao=="1 sao"){
    ?>
    <div class="star">
                                                        <span class="active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                </div>


<?php
}elseif($sosao=="2 sao"){

?>
<div class="star">
                                                             <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                </div>
<?php
}elseif($sosao=="3 sao"){
?>
<div class="star">
          <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="in-active">★</span>
                                                            <span class="in-active">★</span>
                                                </div>
<?php
}elseif($sosao=="4 sao"){

?>
<div class="star">
          <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="in-active">★</span>
                                                </div>

<?php
}else{
?>
<div class="star">
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                            <span class="active">★</span>
                                                </div>


<?php
}
?>

</ul>
            
            </div>

        </div>
    
<div class="row row-phong">
            <div class="large-6 small-6">
            <p>Ăn sáng </p>
            
                
            </div>
            <div class="large-6 small-6">
                    <p><?php echo $an_sang?></p>
            
            </div>

        </div>
        <div class="row row-phong">
            <div class="large-6 small-6">
            <p>Wifi </p>
            
                
            </div>
            <div class="large-6 small-6">
                    <p><?php echo $wifi?></p>
            
            </div>

        </div>







        <?php       
            }
        ?>
            <?php 
           
if($loai=="Tour du lịch"){
echo do_shortcode('[willgroup_book_mini_tour] ');
}
if($loai=="Khách sạn"){
         $giagiam= gia_giam();
        $giagoc=gia_goc();
        if ( $giagiam != 0){

            ?>
        <div class="gia-form-tu-van">
    

<p class="gia-chuan"><span class="tien"><?php echo number_format(gia_giam()); ?></span><span> đồng</span></p>
</div>
            <?php

        }else{
                if ( $giagoc != 0){


        ?>
        <div class="gia-form-tu-van">
                <p class="gia-chuan"><?php echo number_format(gia_goc()); ?><span> đồng</span></p>
                </div>
        
<?php
}
}
global $product;
$id = $product->get_id();
       do_action( 'woocommerce_single_product_summary' );


 
}
?>
     
    </div>
    <?php
}

add_filter('woocommerce_add_to_cart_redirect', 'themeprefix_add_to_cart_redirect');
function themeprefix_add_to_cart_redirect() {
 global $woocommerce;
 $checkout_url = wc_get_checkout_url();
 return $checkout_url;
}



