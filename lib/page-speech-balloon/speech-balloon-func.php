<?php //吹き出し関係の関数

//関数テキストテーブルのバージョン
define('SPEECH_BALLOONS_TABLE_VERSION', '0.1');
define('SPEECH_BALLOONS_TABLE_NAME',  $wpdb->prefix . THEME_NAME . '_speech_balloons');

//関数テキスト移動用URL
define('SB_LIST_URL',   add_query_arg(array('action' => false,   'id' => false)));
define('SB_NEW_URL',    add_query_arg(array('action' => 'new',   'id' => false)));

//デフォルトの名前
define('SB_DEFAULT_NAME', __( '匿名', THEME_NAME ));
//デフォルトアイコン
define('SB_DEFAULT_ICON', get_template_directory_uri().'images/man.png');

//スタイル
define('SBS_STANDARD', 'standard');
define('SBS_FLAT', 'flat');
define('SBS_LINE', 'line');
define('SBS_THINK', 'think');

//サブタイプ
define('SBP_LEFT', 'L');
define('SBP_RIGHT', 'R');

//吹き出しテーブルのバージョン取得
define('OP_SPEECH_BALLOONS_TABLE_VERSION', 'speech_balloons_table_version');
if ( !function_exists( 'get_speech_balloons_table_version' ) ):
function get_speech_balloons_table_version(){
  return get_theme_option(OP_SPEECH_BALLOONS_TABLE_VERSION);
}
endif;

//吹き出しテーブルの作成
if ( !function_exists( 'create_speech_balloons_table' ) ):
function create_speech_balloons_table() {
  // SQL文でテーブルを作る
  $sql = "CREATE TABLE ".SPEECH_BALLOONS_TABLE_NAME." (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    modified datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    title varchar(126),
    name varchar(36),
    icon varchar(256),
    style varchar(20),
    position varchar(20),
    PRIMARY KEY (id),
    INDEX (title),
    INDEX (name)
  )";
  create_db_table($sql);

  set_theme_mod( OP_SPEECH_BALLOONS_TABLE_VERSION, SPEECH_BALLOONS_TABLE_VERSION );
}
endif;
create_speech_balloons_table();


//吹き出しテーブルのアップデート
if ( !function_exists( 'update_speech_balloons_table' ) ):
function update_speech_balloons_table() {
  // オプションに登録されたデータベースのバージョンを取得
  $installed_ver = get_speech_balloons_table_version();
  $now_ver = SPEECH_BALLOONS_TABLE_VERSION;
  if ( is_update_db_table($installed_ver, $now_ver) ) {
    create_speech_balloons_table();
  }
}
endif;
//update_speech_balloons_table();


//吹き出しテーブルのアンインストール
if ( !function_exists( 'uninstall_speech_balloons_table' ) ):
function uninstall_speech_balloons_table() {
  uninstall_db_table(SPEECH_BALLOONS_TABLE_NAME);
  remove_theme_mod(OP_SPEECH_BALLOONS_TABLE_VERSION);
}
endif;


//吹き出しテーブルレコードの取得
if ( !function_exists( 'get_speech_balloons' ) ):
function get_speech_balloons( $keyword = null, $order_by = null ) {
  update_speech_balloons_table();
  global $wpdb;
  $table_name = SPEECH_BALLOONS_TABLE_NAME;
  $where = null;
  if ($keyword) {
    $where = $wpdb->prepare(" WHERE title LIKE %s", '%'.$keyword.'%');
    //$where = (" WHERE title LIKE %%$keyword%%");
  }
  if ($order_by) {
    $order_by = esc_sql(" ORDER BY $order_by");
  }
  $query = "SELECT * FROM {$table_name}".
              $where.
              $order_by;

  $records = $wpdb->get_results( $query );

  return $records;
}
endif;


//吹き出しテーブルレコードの取得
if ( !function_exists( 'get_speech_balloon' ) ):
function get_speech_balloon( $id ) {
  $table_name = SPEECH_BALLOONS_TABLE_NAME;
  $record = get_db_table_record( $table_name, $id );
  $recode->name = !empty($recode->name) ? $recode->name : SB_DEFAULT_NAME;
  $recode->icon = !empty($recode->icon) ? $recode->icon : SB_DEFAULT_ICON;
  $recode->style = !empty($recode->style) ? $recode->style : SBS_FLAT;
  $recode->position = !empty($recode->position) ? $recode->position : SBP_LEFT;

  return $record;
}
endif;
