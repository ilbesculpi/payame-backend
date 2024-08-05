sudo apt update

# Install PHP and Required Extensions
sudo apt install -y php php-cli php-common php-mbstring php-xml php-zip php-mysql php-pgsql php-sqlite3 php-json php-bcmath php-gd php-tokenizer php-xmlwriter

# Install Composer
sudo apt install -y curl php-cli php-mbstring git unzip
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

# Install nginx
sudo apt install -y nginx
