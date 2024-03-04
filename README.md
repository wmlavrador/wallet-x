# Wallet-X

![GitHub repo size](https://img.shields.io/github/repo-size/wmlavrador/wallet-x?style=for-the-badge)
![GitHub language count](https://img.shields.io/github/languages/count/wmlavrador/wallet-x?style=for-the-badge)
![GitHub forks](https://img.shields.io/github/forks/wmlavrador/wallet-x?style=for-the-badge)
![Bitbucket open issues](https://img.shields.io/bitbucket/issues/wmlavrador/wallet-x?style=for-the-badge)
![Bitbucket open pull requests](https://img.shields.io/bitbucket/pr-raw/wmlavrador/wallet-x?style=for-the-badge)

> The Wallet-x system is a small project aimed at training in #DDD, #TDD, #Clean Code, #Clean Architecture, #Docker, 'Queue' with #Redis, and more.

> The idea is to provide a simple transfer of funds between user wallets. Users can transfer funds between Wallets by type, for example, from Wallet type Crypto to Wallet type Crypto, based on certain rules and checks with external services.

### Adjustments and improvements

The project is still under development and the next updates will focus on the following tasks:

- [ ] Define the type of wallet to make transfers
- [ ] Implement notifications on SMS/Whatsapp/Email channels when completing the transaction
- [ ] Routes to obtain transaction details for a given wallet
- [ ] Authenticate routes and authorize transfer by only user authenticated

## 💻 Prerequisites

Before you begin, make sure you meet the following requirements:

- You have installed the latest version of `<git / docker / docker-compose>`

## 🚀 Installing wallet-x

To install wallet-x, follow these steps:

Linux/macOS/Windows:

### 1. Clone o Repositório
Clone this repository to your local environment:
```
git clone git@github.com:wmlavrador/wallet-x.git
```

### 2. Environment Setting
Navigate to the cloned project directory
```
cd wallet-x
```

### 3. Create the .env file
Rename the example file .env.example to .env
```
cp .env.example .env
```

### 4. Initialize Docker Containers
Run the docker-compose up command to start the containers:
```
docker-compose up
```

### Installing Laravel Dependencies
Access the app wallet container
```
docker-compose exec app_wallet_x
```
Inside the container install the dependencies using Composer:
```
composer install
```
Rename laravel .env.example file to .env
```
cp .env.example .env
```
Still inside the container, generate the Laravel encryption key:
```
php artisan key:generate
```
Execute the permissions of the folders used by laravel
```
chown www-data:www-data -R /var/www/storage/logs
chown www-data:www-data -R /var/www/storage/framework
```
Run the migrations, if you prefer you can also feed the database with the seeders with the command
```
php artisan migrate --seed
```

## ☕ Usando Wallet-X
After following the steps above, your application is ready to use

```
http://localhost/api
```

## 😄 Be one of the contributors

Do you want to be part of this project? Click [Here](CONTRIBUTING.md) and read how to contribute.

## 📝 Licença

Esse projeto está sob licença. Veja o arquivo [License](LICENSE.md) for more details.