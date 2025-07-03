# 📘 Course Deleter Plugin for Moodle

This Moodle plugin allows administrators to search for, filter, and delete courses — either manually or automatically based on inactivity.

## 🔧 Features

- Search & bulk delete courses
- Scheduled deletion based on inactivity
- Admin-configurable deletion rules
- Dry-run mode for safe preview
- Email reports of deletions or dry runs
- Fully permission-based

## 📂 Installation

1. Unzip the `deletecourse.zip` file.
2. Place the `deletecourse` folder into your Moodle `/local/` directory.
3. Navigate to **Site administration > Notifications** to complete the installation.

## ⚙️ Configuration

Go to:
**Site administration > course > Course Deleter**

Settings include:
- Enable/Disable scheduled deletion
- Set inactivity threshold (in days)
- Enable dry-run mode
- Notification email for reports

## 🕓 Scheduled Deletion

Runs daily at 2:00 AM server time. Deletes courses not accessed in the configured number of days (default: 365). Honors Moodle capability checks and site settings.

## 🔒 Permissions

Only users with the `local/deletecourse:delete` capability can access or manage course deletions.

## 🧪 Testing

- Try manual deletion from the plugin UI (`/local/deletecourse/index.php`)
- Use "Run now" in **Scheduled Tasks** to test automated deletion.

## 🛠 Requirements

- Moodle 3.9 or higher
- PHP 7.2+

## 📬 Support

For issues or suggestions, contact your Moodle site administrator or plugin developer.
