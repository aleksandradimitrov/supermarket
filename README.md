# 🛒 Laravel Supermarket Checkout System

This project is a supermarket checkout application built with Laravel. It includes a frontend for scanning SKUs, real-time pricing with promotions, and an admin panel for managing products and orders.

## 🚀 Features

### ✅ Frontend (Checkout)
- Real-time total price updates when scanning SKUs
- Supports promotional pricing (e.g. 3 A's for 130)
- Place orders directly from the frontend
- Simple HTML interface

### ✅ Admin Panel
- Dashboard with navigation links
- Manage Products (CRUD)
- Configure multiple special prices per product
- View, edit, and manage orders
- Update order status (created, completed, canceled)
- Add, remove, or edit order items

## 🛠 Technologies
- Laravel 10+
- PHP 8.1+
- MySQL (Dockerized)
- Blade templates
- PSR-4 Autoloading
- Composer-based structure

## 📦 Setup Instructions

### Simple start of the application

```bash
git clone https://github.com/aleksandradimitrov/supermarket.git
cd supermarket

This command will set everything up for you — just make sure Docker is installed on your machine:

```bash
docker-compose up --build