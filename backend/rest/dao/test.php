<?php
require_once 'UserDao.php';

echo "Starting DAO Test...\n";

$userDao = new UserDao();

// 1. Create a user
echo "Creating new user...\n";
$userId = $userDao->create_user("test_user");
echo "New user ID: $userId\n";

// 2. Get user by email
echo "Fetching user by email...\n";
$user = $userDao->get_by_email("test@example.com");
print_r($user);

// 3. Update username
echo "Updating username...\n";
$userDao->update($user['id'], "updated_user");

// Fetch again to confirm
$updatedUser = $userDao->get_by_id($user['id']);
print_r($updatedUser);

// 4. Set personality type (assuming 1 is a valid personality_type_id)
echo "Assigning personality type...\n";
$userDao->set_personality_type($user['id'], 1);

// Confirm update
$userWithType = $userDao->get_by_id($user['id']);
print_r($userWithType);

// 5. Delete user
echo "Deleting user...\n";
$userDao->delete($user['id']);

// 6. Confirm deletion
$deletedUser = $userDao->get_by_id($user['id']);
if (!$deletedUser) {
    echo "User successfully deleted.\n";
} else {
    echo "Failed to delete user.\n";
}

echo "DAO Test complete.\n";
?>

