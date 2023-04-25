FROM node:18.12.1

# Install dependencies
RUN apt-get update && apt-get install -y \
    vim \
    zip \
    unzip \
    curl

# Change current user
#ENV COMPOSER_ALLOW_SUPERUSER 1
USER node
#RUN groupadd -g 1000 www
#RUN useradd -u 1000 -ms /bin/bash -g www www
#RUN chown -R www-data:www-data /var/www
#USER www

#CMD ["sh", "-c", "npm install && npm run dev"]
#CMD ["sh", "-c", "npm install && npm run dev -- --host --port=3000"]
#CMD ["sh", "-c", "npm run dev -- --host --port=3000"]
# RUN npm run dev -- --host --port=3000
