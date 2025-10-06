# Spray App
A simple CRUD application that can manage spray machines work hours.

## Features
- User Registration/Login
- Spray Machine CRUD Operations
- Record hours and reset hours

## Tech Stack
- **Backend:** Laravel
- **Frontend:** Vue.js with Pinia for state management
- **Database:** MySQL (SQLite for unit tests) 

## Installation Guide
### Prerequisites
- PHP 8.2
- Composer
- Node.js & npm
- MySQL

### Setup Steps
#### Backend (Laravel)
1. Clone the repository:
   ```bash
   git clone https://github.com/ArunaUsitha/spray-app.git
   cd spray-app
   ```
2. Install dependencies:
   ```bash
   cd backend
   composer install
   ```
3. Create and configure the `.env` file:
   ```bash
   cp .env.example .env
   ```
    - Update database configurations in the `.env` file.
4. Run migrations:
   ```bash
   php artisan migrate --seed
   ```
5. Generate application key:
   ```bash
   php artisan key:generate
   ```
6. Start the Laravel server:
   ```bash
   php artisan serve
   ```

#### Frontend (Vue.js)
1. Navigate to the frontend directory:
   ```bash
   cd frontend
   ```
2. Install dependencies:
   ```bash
   npm install
   ```
3. Start the Vue.js development server:
   ```bash
   npm run dev
   ```

## Usage
- Access the application at `http://localhost:5173` (or as configured).
- Login with user credentials.
  `admin@sprayapp.com : 12345`



