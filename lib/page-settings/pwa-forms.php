<?php /**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit; ?>

<div class="metabox-holder">

<!-- PWA -->
<div id="page-pwa" class="postbox">
  <h2 class="hndle"><?php _e( 'PWA設定（β版）', THEME_NAME ) ?></h2>
  <div class="inside">

    <p><?php _e( 'PWA（Progressive Web Apps）とは、モバイル向けWebサイトをスマートフォン向けアプリのように使える仕組みです。<span class="red">
    現在β版機能となっています。不具合が起きても対処できる方の利用をおすすめします。よくわからない場合は利用しないことをおすすめします。</span>', THEME_NAME );
    echo get_help_page_tag('https://wp-cocoon.com/pwa/'); ?></p>

    <?php if (!is_ssl()): ?>
    <p class="alert"><?php _e( 'PWAを利用するにはサイトをSSL化（https化）する必要があります。httpサイトでは、当設定項目を変更しても反映されません。', THEME_NAME ) ?></p>
    <?php endif; ?>

    <!-- PWA囲み -->
    <div <?php echo get_not_allowed_form_class(is_ssl()); ?>>

    <table class="form-table">
      <tbody>

        <!-- PWAの有効化 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_PWA_ENABLE, __( 'PWAの有効化', THEME_NAME )); ?>
          </th>
          <td>
            <?php
            generate_checkbox_tag(OP_PWA_ENABLE, is_pwa_enable(), __("PWAを有効化する",THEME_NAME ));
            generate_tips_tag(__( '有効化することで、PWA機能が有効化されスマートフォンからサイトがアプリのように利用できます。', THEME_NAME ));
            ?>
            <div class="indent">
              <?php
              generate_checkbox_tag(OP_PWA_ADMIN_ENABLE, is_pwa_admin_enable(), __("ログイン時もPWAを有効化する",THEME_NAME ));
              generate_tips_tag(__( 'ユーザーがログイン時のPWA動作を制御します。', THEME_NAME ));
              ?>
            </div>
          </td>
        </tr>

        <!-- 名前 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag('', __( '名前', THEME_NAME )); ?>
          </th>
          <td>
          <?php
            generate_label_tag(OP_PWA_NAME, __('アプリ名', THEME_NAME) );
            echo '<br>';
            generate_textbox_tag(OP_PWA_NAME, get_pwa_name(), '');
            generate_tips_tag(__( 'WEBアプリ名として表示される名前を入力してるださい。', THEME_NAME ));

            generate_label_tag(OP_PWA_SHORT_NAME, __('短いアプリ名', THEME_NAME) );
            echo '<br>';
            generate_textbox_tag(OP_PWA_SHORT_NAME, mb_substr(get_pwa_short_name(), 0, 12), '');
            generate_tips_tag(__( 'アプリの短縮名を入力してください。ホーム画面に表示される短い名前で利用されます。※最大12文字', THEME_NAME ));
            ?>
            <p class="alert"><?php _e( '13文字以降は自動的に削除されます。', THEME_NAME ) ?></p>
          </td>
        </tr>

        <!-- 説明文 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_PWA_DESCRIPTION, __( '説明文', THEME_NAME )); ?>
          </th>
          <td>
          <?php
            generate_textbox_tag(OP_PWA_DESCRIPTION, get_pwa_description(), '');
            generate_tips_tag(__( 'アプリの説明文を入力してください。最大132文字まで。', THEME_NAME ));
          ?>
          </td>
        </tr>

        <!-- 配色 -->
        <tr>
          <th scope="row">
            <?php generate_label_tag('', __('配色', THEME_NAME) ); ?>
            <?php generate_select_color_tip_tag(); ?>
          </th>
          <td>
            <?php
            generate_color_picker_tag(OP_PWA_THEME_COLOR,  get_pwa_theme_color(), 'テーマカラー');

            generate_tips_tag(__( 'アプリのテーマカラーです。OSによってどこに適用されるかは異なります。', THEME_NAME ));

            generate_color_picker_tag(OP_PWA_BACKGROUND_COLOR,  get_pwa_background_color(), '背景色');
            generate_tips_tag(__( 'アプリの背景色です。サイトが表示されるまでの間、この色が適用される場合があります。', THEME_NAME ));
            ?>
          </td>
        </tr>

        <!-- 表示モード -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_PWA_DISPLAY, __( '表示モード', THEME_NAME )); ?>
          </th>
          <td>
            <?php
            $options = array(
              'fullscreen' => __( 'fullscreen（利用可能な表示エリアを全て使用）', THEME_NAME ),
              'standalone' => __( 'standalone（ナビゲーションの制御のためのインターフェース非表示）', THEME_NAME ),
              'minimal-ui' => __( 'minimal-ui（最小限のインターフェース）', THEME_NAME ),
              'browser' => __( 'browser（従来のブラウザーと同じインターフェース）', THEME_NAME ),
            );
            generate_selectbox_tag(OP_PWA_DISPLAY, $options, get_pwa_display());
            generate_tips_tag(__( 'インターフェースの表示モードの設定です。', THEME_NAME ));
            ?>
          </td>
        </tr>

        <!-- 画面の向き -->
        <tr>
          <th scope="row">
            <?php generate_label_tag(OP_PWA_ORIENTATION, __( '画面の向き', THEME_NAME )); ?>
          </th>
          <td>
            <?php
            $options = array(
              'any' => __( 'any（回転を許可）', THEME_NAME ),
              'landscape' => __( 'landscape（縦方向に固定）', THEME_NAME ),
              'portrait' => __( 'portrait（横方向に固定）', THEME_NAME ),
            );
            generate_selectbox_tag(OP_PWA_ORIENTATION, $options, get_pwa_orientation());
            generate_tips_tag(__( '画面の縦方向、横方向の向きを設定します。', THEME_NAME ));
            ?>
          </td>
        </tr>

      </tbody>
    </table>

    </div><!-- /PWA囲み -->

  </div>
</div>

</div><!-- /.metabox-holder -->
