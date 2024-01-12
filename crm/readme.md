# Unite name for categories or services

```
function make_unique_name($table, $column, $name) {
        global $wpdb;
        $count = 1;
        $original_name = $name;

        while ($wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table WHERE $column = %s", $name)) > 0) {
            $name = $original_name . '-' . ++$count;
        }

        return $name;
    }
```

# Shortcodes

```
[crm_search zip="" city='' service='' category='Awesome']
```
