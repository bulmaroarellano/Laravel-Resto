<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'menus' => [
        'name' => 'Menus',
        'index_title' => 'Menus List',
        'new_title' => 'New Menu',
        'create_title' => 'Create Menu',
        'edit_title' => 'Edit Menu',
        'show_title' => 'Show Menu',
        'inputs' => [
            'code' => 'Code',
            'article' => 'Article',
            'description' => 'Description',
            'price' => 'Price',
        ],
    ],

    'customers' => [
        'name' => 'Customers',
        'index_title' => 'Customers List',
        'new_title' => 'New Customer',
        'create_title' => 'Create Customer',
        'edit_title' => 'Edit Customer',
        'show_title' => 'Show Customer',
        'inputs' => [
            'dni' => 'Dni',
            'fiscal_code' => 'Fiscal Code',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'telephone' => 'Telephone',
            'email' => 'Email',
            'company_name' => 'Company Name',
        ],
    ],

    'events' => [
        'name' => 'Events',
        'index_title' => 'Events List',
        'new_title' => 'New Event',
        'create_title' => 'Create Event',
        'edit_title' => 'Edit Event',
        'show_title' => 'Show Event',
        'inputs' => [
            'customer_id' => 'Customer',
            'guests_number' => 'Guests Number',
            'date' => 'Date',
            'start_our' => 'Start Our',
            'start_end' => 'Start End',
        ],
    ],

    'settings' => [
        'name' => 'Settings',
        'index_title' => 'Settings List',
        'new_title' => 'New Setting',
        'create_title' => 'Create Setting',
        'edit_title' => 'Edit Setting',
        'show_title' => 'Show Setting',
        'inputs' => [
            'bussines_name' => 'Bussines Name',
            'telephone' => 'Telephone',
            'email' => 'Email',
            'logo' => 'Logo',
            'discount_credit_card' => 'Discount Credit Card',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'invoices' => [
        'name' => 'Invoices',
        'index_title' => 'Invoices List',
        'new_title' => 'New Invoice',
        'create_title' => 'Create Invoice',
        'edit_title' => 'Edit Invoice',
        'show_title' => 'Show Invoice',
        'inputs' => [
            'amount' => 'Amount',
            'due_at' => 'Due At',
            'paid_at' => 'Paid At',
            'customer_id' => 'Customers',
            'event_id' => 'Event',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
