FROM ccr.ccs.tencentyun.com/w7team/swoole:cli-php7.4
MAINTAINER yuanwentao <we7team@qq.com>

ENV WEB_PATH /home/miiot.we7.cc
ADD ./ $WEB_PATH
WORKDIR $WEB_PATH

RUN composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/

RUN php -d memory_limit=-1 `which composer` install --no-dev && composer clearcache \
    && chown -R www:www $WEB_PATH \
    && chmod -R 755 $WEB_PATH

EXPOSE 80