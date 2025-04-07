<?php
require_once 'UserDao.php';

echo "Starting DAO Test...\n";

$userDao = new UserDao();

// 1. Create a user
echo "Creating new user...\n";
$userId = $userDao->create("test_user", "test_pass", "test@example.com");
echo "New user ID: $userId\n";

// 2. Get user by email
echo "Fetching user by email...\n";
$user = $userDao->getByEmail("test@example.com");
print_r($user);

// 3. Update username
echo "Updating username...\n";
$userDao->update($user['id'], "updated_user", "test@example.com");

// Fetch again to confirm
$updatedUser = $userDao->getById($user['id']);
print_r($updatedUser);

// 4. Set personality type (assuming 1 is a valid personality_type_id)
echo "Assigning personality type...\n";
$userDao->setPersonalityType($user['id'], 1);

// Confirm update
$userWithType = $userDao->getById($user['id']);
print_r($userWithType);

// 5. Delete user
echo "Deleting user...\n";
$userDao->delete($user['id']);

// Confirm deletion
$deletedUser = $userDao->getById($user['id']);
if (!$deletedUser) {
    echo "User successfully deleted.\n";
} else {
    echo "Failed to delete user.\n";
}

echo "DAO Test complete.\n";
?>
