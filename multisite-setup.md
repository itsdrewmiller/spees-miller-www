# WordPress Multisite Setup Instructions

**Important**: The multisite setup requires modifications to your host computer's hosts file. This allows proper domain resolution for the family subdomains.

## Step 1: Add Host Entries
Add the following entries to your hosts file:
- On Mac/Linux: Edit `/etc/hosts` (use `sudo nano /etc/hosts`)
- On Windows: Edit `C:\Windows\System32\drivers\etc\hosts` (open as Administrator)

```
127.0.0.1 spees-miller.local
127.0.0.1 www.spees-miller.local
127.0.0.1 maxwell.spees-miller.local
127.0.0.1 magnus.spees-miller.local
127.0.0.1 tycho.spees-miller.local
127.0.0.1 drew.spees-miller.local
127.0.0.1 kathleen.spees-miller.local
```

## Step 2: Access the WordPress Admin
1. Go to http://spees-miller.local:8080/wp-admin/
2. Log in with your admin credentials (create an account if this is your first time)
3. If you're asked to configure a network, follow these steps:
   - Select "Sub-domains" installation type
   - Enter a network title like "Spees-Miller Family Site"
   - Enter your email address
   - Click "Install"

## Step 3: Create Subsites
1. Navigate to "My Sites" > "Network Admin" > "Sites" > "Add New"
2. Create a new site for each family member:
   - Site Address: maxwell.spees-miller.local (subdomain)
   - Site Title: Maxwell's Site
   - Admin Email: (use your admin email or create one for each user)
3. Repeat for each family member (magnus, tycho, drew, kathleen)

## Step 4: Create User Accounts
1. Go to "Users" > "Add New" in the Network Admin
2. Create accounts for each family member
3. Give each user the "Administrator" role but only for their specific site

## Step 5: Configure User Permissions
1. Install and activate "User Role Editor" plugin
2. Go to "Users" > "User Role Editor" in the Network Admin
3. Set up each user with appropriate permissions:
   - Maxwell as Administrator for maxwell.spees-miller.local
   - Magnus as Administrator for magnus.spees-miller.local
   - And so on...

## Step 6: Test Access
1. Log out of the admin account
2. Log in as Maxwell
3. Verify that Maxwell can only edit maxwell.spees-miller.local
4. Repeat for other users

## Additional Notes
- Users will need to go to their specific subdomain to log in (e.g., http://maxwell.spees-miller.local:8080/wp-admin/)
- Each user should only see their own site in the admin dashboard
- The super admin (you) can access and edit all sites