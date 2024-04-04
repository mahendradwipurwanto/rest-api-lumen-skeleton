**Rest API Lumen Skeleton Product Service**

---

### Introduction
This repository serves as a skeleton for building a RESTful API using Lumen 10, a lightweight PHP micro-framework. It's designed to provide a starting point for developing CRUD (Create, Read, Update, Delete) operations and handling transactions in a structured manner.

### Features
- **CRUD Operations**: Implement basic CRUD functionality for managing products.
- **Transactions**: Demonstrates handling transactions within the API endpoints.
- **Modular Structure**: Organized codebase for better maintainability and scalability.
- **Customizable**: Easily extendable to fit specific project requirements.

### Prerequisites
- PHP >= 8.2
- Composer
- Lumen 10 Framework

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/mahendradwipurwanto/rest-api-lumen-skeleton-product-service.git
   ```

2. Navigate to the project directory:
   ```bash
   cd rest-api-lumen-skeleton-product-service
   ```

3. Install dependencies:
   ```bash
   composer install
   ```

4. Configure the environment:
    - Rename `.env.example` to `.env` and configure your database settings.

5. Run the migration:
   ```bash
   php artisan migrate
   ```

6. Start the development server:
   ```bash
   php -S localhost:8000 -t public
   ```

### Usage
- **Endpoints**:
You can import postman collection from file `Lumen-Rest-API-Product-Service.postman_collection.json` to your postman application

### Directory Structure
```
rest-api-lumen-skeleton-product-service/
├── app/
│   ├── Helpers/
│   │   ├── GlobalHelper.php
│   │   └── ResponseHelper.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HealthController.php
│   │   │   ├── ProductController.php
│   │   │   └── StockController.php
│   │   ├── Requests/
│   │   │   ├── ProductRequest.php
│   │   │   └── StockRequest.php
│   │   └── Resources/
│   │       ├── ProductResource.php
│   │       └── StockResource.php
│   ├── Models/
│   │   ├── Product.php
│   │   └── Stock.php
│   └── Traits/
│       ├── Product.php
│       └── Stock.php
├── bootstrap/
│   └── app.php
├── database/
│   ├── factories/
│   │   ├── ProductFactory/
│   │   └── StockFactory.php
│   ├── migrations/
│   │   ├── {timestamp}_products.php
│   │   └── {timestamp}_stocks.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── ProductSeeder.php
│       └── StockSeeder.php
├── routes/
│   └── api.php
├── .env.example
├── .gitignore
├── composer.json
└── Lumen-Rest-API-Product-Service.postman_collection.json
```

### Contributing
Contributions are welcome! Feel free to open issues or pull requests for any improvements or features you'd like to see added.

### License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

### Acknowledgments
Special thanks to the Lumen framework developers for providing a lightweight and efficient tool for building APIs.

### Disclaimer
This repository is intended for educational and demonstration purposes only. It may not be suitable for production use without further customization and testing.

---

Feel free to customize this README to fit your specific project details and requirements. If you have any questions or need further assistance, don't hesitate to reach out!
