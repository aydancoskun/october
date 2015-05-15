<?php
return [
    'plugin' => [
        'name' => 'Subscriber',
        'description' => 'Subscriber management.'
    ],
    'locations' => [
        'menu_label' => 'Locations',
        'menu_description' => 'Manage available subscription countries and counties/states.',
        'enabled_help' => 'Disabled locations are not visible to subscribers.'
    ],
    'users' => [
        'menu_label' => 'Subscribers',
        'all_users' => 'All Subscribers',
        'new_user' => 'New Subscriber',
        'list_title' => 'Manage Subscribers',
        'activate_warning_title' => 'Subscriber not activated!',
        'activate_warning_desc' => 'This subscriber has not been activated and will be unable to login.',
        'activate_confirm' => 'Do you really want to activate this subscriber?',
        'active_manually' => 'Activate this subscriber manually',
        'delete_confirm' => 'Do you really want to delete this subscriber?',
        'activated_success' => 'Subscriber has been activated successfully!',
        'return_to_list' => 'Return to list of subscribers',
        'delete_selected_empty' => 'No subscribers selected to delete.',
        'delete_selected_confirm' => 'Delete the selected subscribers?',
        'delete_selected_success' => 'Successfully deleted the selected subscribers.'
    ],
    'settings' => [
        'users' => 'Subscribers',
        'menu_label' => 'Subscriber settings',
        'menu_description' => 'Manage subscriber based settings.',
        'activation_tab' => 'Activation',
        'signin_tab' => 'Login',
        'activate_mode_comment' => 'Select how a subscriber account should be activated.',
        'activate_mode_auto' => 'Immediately',
        'activate_mode_auto_comment' => 'Activated immediately upon registration.',
        'activate_mode_user' => 'Subscriber verifies email',
        'activate_mode_user_comment' => 'The subscriber activates their own account using email verification.',
        'activate_mode_admin_comment' => 'Only an Administrator can activate a subscriber.',
        'welcome_template_comment' => 'Mail template to send a subscriber when they are first activated.',
        'require_activation' => 'Login requires activation',
        'require_activation_comment' => 'Subscribers must have an activated account to login.',
        'default_country_comment' => 'When a subscriber does not specify their country, select default to use.',
        'default_state' => 'Default County/State',
        'default_state_comment' => 'When a subscriber does not specify their county/state, select default to use.',
        'use_throttle_comment' => 'Repeat failed login attempts will temporarily suspend the subscriber.',
        'login_attribute' => 'Login attribute',
        'login_attribute_comment' => 'Select what should be used for loggin in.'
    ],
    'state' => [
        'label' => 'County/State',
        'name' => 'Name',
        'name_comment' => 'Enter the display name for this county/state.',
        'code' => 'Code',
        'code_comment' => 'Enter a unique code to identify this county/state.'
    ],
    'user' => [
        'label' => 'Subscriber',
        'zip' => 'Postcode/Zip',
        'state' => 'State',
        'select_state' => '-- select county/state --',
        'confirm_password_comment' => 'Enter the password again to confirm it.'
    ],
    'account' => [
        'account_desc' => 'Subscriber management form.',
        'invalid_activation_code' => 'Sorry, this link is invalid.',
        'invalid_user' => 'No matching subscriber found.',
        'success_activation' => 'Successfully activated your email address.',
        'login_first' => 'You must login first!',
        'alredy_active' => 'Your email is already verified!',
        'activation_email_sent' => 'Verification email sent!',
        'state' => 'County/State',
        'sign_in' => 'Login',
        'login' => 'Login',
        'city_suburb' => 'City / Town',
        'postal_code' => 'Postcode/Zip'
    ],
    'session' => [
        'session_desc' => 'Adds ability to restrict page access to subscribers.',
        'users' => 'Subscribers',
        'logout' => 'You have been successfully logged out!'
    ]
];
