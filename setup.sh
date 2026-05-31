#!/bin/bash

echo "Setting up CommunityConnect..."

# Install PHP dependencies
echo "Installing PHP dependencies..."
composer install --no-interaction --prefer-dist

# Copy environment file
if [ ! -f .env ]; then
    cp .env.example .env
    echo "Created .env from .env.example"
else
    echo ".env already exists, skipping..."
fi

# Generate app key
echo "Generating application key..."
php artisan key:generate

# Prompt for database credentials
echo ""
echo "Database setup"
echo "--------------"
read -p "Database name (default: communityconnect): " DB_NAME
DB_NAME=${DB_NAME:-communityconnect}

read -p "Database username (default: root): " DB_USER
DB_USER=${DB_USER:-root}

read -sp "Database password (leave blank if none): " DB_PASS
echo ""

# Update .env with DB credentials
sed -i.bak "s/^DB_DATABASE=.*/DB_DATABASE=${DB_NAME}/" .env
sed -i.bak "s/^DB_USERNAME=.*/DB_USERNAME=${DB_USER}/" .env
sed -i.bak "s/^DB_PASSWORD=.*/DB_PASSWORD=${DB_PASS}/" .env
rm -f .env.bak

# Run migrations
echo "Running database migrations..."
php artisan migrate --force

# Install JS dependencies and build assets
echo "Installing frontend dependencies..."
npm install

echo "Building frontend assets..."
npm run build

echo ""
echo "Setup complete!"
echo ""
echo "To start the development server run:"
echo "  php artisan serve"
echo ""
echo "Then open http://localhost:8000 in your browser."
echo ""
echo "To create an admin account, register on the site then run:"
echo "  php artisan tinker --execute=\"App\Models\User::where('email','your@email.com')->update(['role'=>'admin']);\""
