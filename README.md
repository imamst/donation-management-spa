## Donation Management SPA
Single page application based on Vue, to manage and monitor donation and spending

Build using:

* PHP / Laravel 7
* Sanctum
* Vue
* PostgreSQL
* AdminLTE Template

Features:

- Monitoring Dashboard with Today Donation & Spending Report
- Donation & Spending Management
- Print Donation Receipt
- Daily, Monthly and Annual Report in PDF file format
- User Account Management and Restriction (block & unblock account)

# Live demo:

https://imamsetiawan.id/projects/donation-management-spa/

* email: super.admin@example.com
* password: 12345678

# Screenshots

![img](https://github.com/onestica/donation-management-spa/blob/main/public/docs/login-page.png?raw=true)
![img](https://github.com/onestica/donation-management-spa/blob/main/public/docs/dashboard.png?raw=true)
![img](https://github.com/onestica/donation-management-spa/blob/main/public/docs/donasi-index.png?raw=true)
![img](https://github.com/onestica/donation-management-spa/blob/main/public/docs/donation-input.png?raw=true)
![img](https://github.com/onestica/donation-management-spa/blob/main/public/docs/annual-report.png?raw=true)
![img](https://github.com/onestica/donation-management-spa/blob/main/public/docs/user-restriction.png?raw=true)

## Getting Started

* Download or clone repository `https://github.com/onestica/digital-printing-inventory-management-system`
* Create database `donation-management`
* Open `env.example` file, adjust to your env config: 
	* `APP_URL`
	* `SANCTUM_STATEFUL_DOMAINS` => fill in same as `APP_URL`
	* `MIX_APP_URL` => fill in same as `APP_URL`
	* `DB_USERNAME`
	* `DB_PASSWORD`
* Open terminal inside project folder
* Run command `npm run watch`
* Open another terminal
* Run command `php artisan key:generate`
* Run command `php artisan migrate:refresh` (without demo data)
	* Or `php artisan migrate:refresh --seed` (with demo data)
* Run command `php artisan serve` then access http://localhost:8000 in your browser

## Author Contact

- Email - [imamset.business@gmail.com](mailto:imamset.business@gmail.com)
- Website - [Imam Setiawan](https://imamsetiawan.id)