# TODO: Add Fields to Users Table Migration

## Completed Steps

1. **Edit Migration File**: ✅ Added new columns to `database/migrations/0001_01_01_000000_create_users_table.php`
   - Added `retype_password` (string, nullable)
   - Added `first_name` (string, nullable)
   - Added `last_name` (string, nullable)
   - Added `phone_number` (string, unique, nullable)
   - Added `otp` (string, nullable)

2. **Edit User Model**: ✅ Updated `app/Models/User.php` to include new fields in `$fillable` array

3. **Fix Validation**: ✅ Updated `app/Http/Controllers/RegisterController.php` to ensure `password` and `retype_password` match using 'same' rule

## Remaining Steps

4. **Run Migration**: Execute `php artisan migrate` to apply changes to the database

5. **Optional**: Update UserFactory if needed for testing
