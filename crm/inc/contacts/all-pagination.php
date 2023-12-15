<?php
// Verifica si la clase WP_List_Table está disponible
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class CRM_Contacts_List_Table extends WP_List_Table
{
    private $table_name;

    public function __construct()
    {
        parent::__construct(array(
            'singular' => 'contact',
            'plural'   => 'contacts',
            'ajax'     => false
        ));

        $this->table_name = $wpdb->prefix . 'crm_contacts';
    }

    public function prepare_items()
    {
        global $wpdb;

        $per_page = 5;
        $current_page = $this->get_pagenum();
        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $this->table_name");

        $this->set_pagination_args(array(
            'total_items' => $total_items,
            'per_page'    => $per_page,
        ));

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = array($columns, $hidden, $sortable);

        $offset = ($current_page - 1) * $per_page;

        $this->items = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM $this->table_name ORDER BY %s %s LIMIT %d OFFSET %d",
            $this->_args['orderby'],
            $this->_args['order'],
            $per_page,
            $offset
        ), ARRAY_A);
    }

    public function get_columns()
    {
        return array(
            'cb' => '<input type="checkbox" />',
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'category' => 'Category',
            'service' => 'Service',
        );
    }

    public function column_default($item, $column_name)
    {
        return esc_html($item[$column_name]);
    }

    public function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="delete_contact_ids[]" value="%s" />',
            esc_attr($item['id'])
        );
    }

    public function get_sortable_columns()
    {
        return array(
            'id' => array('id', false),
            'first_name' => array('first_name', false),
            'last_name' => array('last_name', false),
            'category' => array('category', false),
            'service' => array('service', false),
        );
    }

    public function display()
    {
        $this->display_tablenav('top');
        echo '<table class="wp-list-table ' . implode(' ', $this->get_table_classes()) . '">';
        $this->display_rows_or_placeholder();
        echo '</table>';
        $this->display_tablenav('bottom');
    }
}

// Instanciar y configurar la tabla
$contacts_list_table = new CRM_Contacts_List_Table();
$contacts_list_table->prepare_items();
?>

<div class="all-contacts">

    <div class="options">
        <ul>
            <li>
                <a class='btn' href="<?php echo admin_url('admin.php?page=new-contact'); ?>">
                    <span class="iconify color-green" data-icon="material-symbols:add-circle"
                        data-inline="false"></span>
                    <span>Add Contact</span>
                </a>
            </li>
            <li>
                <button class="btn">
                    <span class="iconify color-red" data-icon="material-symbols:delete-forever"
                        data-inline="false"></span>
                    <span>Delete</span>
                </button>
            </li>
        </ul>
    </div>

    <form method="post" action="">
        <?php $contacts_list_table->display(); ?>
    </form>

</div>