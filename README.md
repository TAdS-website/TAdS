# TAdS Website
## Installation

### File Structure

1. `configs` directory should be kept just outside the served directory
2. `tads` directory is equivalent to the served directory. ie. content inside this directory should be served.

### Database Configuration

1. Open `configs/tads-config.php`  and Update the variables `db_host`, `db_user`, `db_password`, `db_name` with appropriate values
2. Import database schema by importing `configs/contacts.sql` in the mysql database

### Other Configurations

1. Open `configs/tads-config.php`  and Update the variable `SITE_INDEX_URL` with url of the index of served website.
