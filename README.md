

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



