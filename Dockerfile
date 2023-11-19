FROM nginx
COPY docker/build/nginx/boombower.prod.conf /etc/nginx/conf.d/default.conf
COPY /backend /boombower/backend
RUN sed -e 's/^worker_processes.*/worker_processes 5;/' -i /etc/nginx/nginx.conf

EXPOSE 80
