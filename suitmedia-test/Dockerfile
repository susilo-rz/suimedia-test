# Gunakan image PHP bawaan
FROM php:8.2-cli

# Install server tools
RUN apt-get update && apt-get install -y git unzip curl

# Salin semua file ke dalam container
COPY . /app
WORKDIR /app

# Jalankan built-in PHP server
CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]
