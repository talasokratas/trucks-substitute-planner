# Trucks Substitute Planner

## Description

The Trucks Substitute Planner is a Laravel-based application designed to manage truck details and their subunits. It provides functionalities such as viewing truck lists, assigning subunits to trucks, and editing truck information. This project aims to streamline the management of truck assignments and ensure easy tracking of related data.

## Repository

[Trucks Substitute Planner GitHub Repository](https://github.com/talasokratas/trucks-substitute-planner)

## Installation

To set up the project on your local machine, follow these steps:

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/talasokratas/trucks-substitute-planner.git
   cd trucks-substitute-planner
2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   
3. **Set Up the Environment**:

   Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env

4. **Run Migrations and Seed the Database**:

   ```bash
   php artisan migrate --seed

5. **Start the Development Server**:

   ```bash
   php artisan serve
