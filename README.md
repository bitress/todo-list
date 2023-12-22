
# To-Do List using PHP and ReactJs

Effortlessly manage tasks with our ReactJS + PHP To-Do List. Real-time updates, data persistence, and easy integration for a seamless task management experience.

## Underdevelopment
Please note that this project is currently under development, and certain features or functionalities may not be fully developed. We are actively working on improving and enhancing the application.

## Installation

### 1. Install To-Do List Backend

Use [Composer](https://getcomposer.org/) to install the necessary dependencies for the To-Do List Backend.

```bash
composer install
```

### 2. Generate PEM Key for Authentication
Generate a PEM key for secure authentication. Run the following command and follow the prompts:

```bash
ssh-keygen -t rsa -m pem
```

Enter the file path to save the key (e.g., /path/to/your/folder/private_key.pem).

### 3. Set Environment Variables
Create a .env file in the root of your project and add the following environment variable:

```bash
JWT_PASSPHRASE={PEM FILE PASSPHRASE}
```


### 4. Install To-Do List Frontend using npm

Navigate to the todo-list directory and use npm to install the required dependencies for the To-Do List Frontend.

```bash
cd todo-list
npm install
```




## Usage/Examples


Run the To-Do List Backend

```bash 
# Replace with your preferred web server command
php -S localhost:8000
```

Run the To-Do List Frontend

```bash
cd todo-list
npm run dev
```

## Additional Notes
- Ensure that Composer and npm are installed on your system before proceeding.
- Make sure to handle any prompts during the key generation process.
- Customize the file path for saving the private key according to your preferences.




# Authors
- [@bitress](https://www.github.com/bitress)
