<?php
namespace Yours\Plugin\AdminColumns;
use Yours\Plugin\Plugin;



/* 
 attention with line $queryargs['orderby'] = 'meta_value_num';
 this runs the values as "Numbers"
 change to $queryargs['orderby'] = 'meta_value';
 to orderby string value
 */

/**
 * Class provides functionality to quick edit meta-value in quickedit (fieldName) 
 */
class NumberInMap extends Plugin
{
    private $fieldName   = "casestudy_number";
    private $postTypes   = ['team'];
    // private $unique;
    private $JS_FILENAME = "populatequickedit-num_in_map";

    public function __construct()
    {
        // add_action( 'rest_api_init', array($this,'yours_register_rest_routes'));
        foreach ($this->postTypes as $pt) {
            $filterName  = "manage_" . $pt . "_posts_columns";
            $filterName1 = "manage_" . $pt . "_posts_custom_column";
            $filterName2 = "manage_edit-" . $pt . "_sortable_columns";
            add_filter($filterName, array($this, 'add_columns'));
            add_filter($filterName1, array($this, 'custom_column'), 10, 2);
            add_action('request', array($this, 'orderby_custom_value'));
            add_filter($filterName2, array($this, 'sortable_columns'), 10, 1);
            add_action('quick_edit_custom_box', array($this, 'add_quick_edit'), 10, 2);
            add_filter('post_row_actions', array($this, 'quickedit_set_data'), 10, 2);
            add_action('admin_enqueue_scripts', array($this, 'enqueue_quick_edit_population'));
            add_action('save_post', array($this, 'edit_save'));
            // $this->uniqid = uniqid();
            // add_action('admin_print_footer_scripts', array($this,'quickedit_javascript'));

        }

    }

    public function edit_save($post_id)
    {
        // check user capabilities
        // check user capabilities
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // check nonce
        if (!wp_verify_nonce($_POST['larslo_nonce'], 'larslo_quick_edit_nonce')) {
            return;
        }

        // update the field
        if (isset($_POST[$this->fieldName])) {
            update_post_meta($post_id, $this->fieldName, $_POST[$this->fieldName]);
        }

    }

    public function enqueue_quick_edit_population($pagehook)
    {
        // do nothing if we are not on the target pages
        if ('edit.php' != $pagehook) {
            return;
        }
        $fn = $this->JS_FILENAME;
        wp_enqueue_script($fn, plugin_dir_url(__FILE__) . "js/" . $fn . ".js", array('jquery'));
    }

    public function quickedit_set_data($actions, $post)
    {
        $found_value = get_post_meta($post->ID, $this->fieldName, true);
        if ($found_value) {
            if (isset($actions['inline hide-if-no-js'])) {
                $new_attribute                   = 'data-' . $this->fieldName . '="' . $found_value . '"';
                $actions['inline hide-if-no-js'] = str_replace('class=', "$new_attribute class=", $actions['inline hide-if-no-js']);
            }
        }
        return $actions;
    }

    /* populate trans value when  Quick Edit box is being opened. */
    public function yours_translation_quickedit_set_data($actions, $post)
    {
        $found_value = get_post_meta($post->ID, 'translation_id', true);

        if ($found_value) {
            if (isset($actions['inline hide-if-no-js'])) {
                $new_attribute                   = sprintf('data-translation-id="%s"', $found_value);
                $actions['inline hide-if-no-js'] = str_replace('class=', "$new_attribute class=", $actions['inline hide-if-no-js']);
            }
        }

        return $actions;
    }

    public function add_quick_edit($column_name, $post_type)
    {
        if ($this->fieldName != $column_name || !in_array($post_type, $this->postTypes)) {
            return;
        }
        wp_nonce_field('larslo_quick_edit_nonce', 'larslo_nonce');

        ?>
      <fieldset class="inline-edit-col-left">
          <div class="inline-edit-col">
              <label>
                  <span class="title">No# in Maps</span>
                  <span class="input-text-wrap"><input name="<?php echo $this->fieldName ?>" class="inline-edit-menu-order-input <?php echo $this->fieldName ?>" type="text" value="" ></span>
          </label>
          </div>
      </fieldset>
      <?php
}

    public function orderby_custom_value($queryargs)
    {
        if (!is_admin()) {
            return $queryargs;
        }
        if(array_key_exists('orderby', $queryargs)) {
            if ($this->fieldName == $queryargs['orderby']) {
                $queryargs['meta_key'] = $this->fieldName;
                $queryargs['orderby'] = 'meta_value_num';
            }
        }
        return $queryargs;
    }

    /* make columns sortable*/
    public function sortable_columns($columns)
    {
        // $columns[$this->fieldName] = $this->fieldname."_";
        $columns[$this->fieldName] = $this->fieldName;
        return $columns;
    }

    public function custom_column($column, $post_id)
    {

        if ($this->fieldName === $column) {
            $tid = get_post_meta($post_id, $this->fieldName, true);
            echo ($tid !== "") ? $tid : "NONE";
        }
    }
    public function add_columns($columns)
    {
        $columns[$this->fieldName] = __('No# in Map');
        return $columns;
    }
}
