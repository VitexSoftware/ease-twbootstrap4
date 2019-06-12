#DESTDIR ?= debian/php-ease-twbootstrap4/DEBIAN
#libdir  ?= /usr/share/php/Ease
#docdir  ?= /doc/ease-twbootstrap/twbootstrap

all: build install

fresh:
	git pull origin master
	PACKAGE=`cat debian/composer.json | grep '"name"' | head -n 1 |  awk -F'"' '{print $4}'`; \
	VERSION=`cat debian/composer.json | grep version | awk -F'"' '{print $4}'`; \
	dch -b -v "${VERSION}" --package ${PACKAGE} "$CHANGES" \
	composer install
	
#install:
#	mkdir -p $(DESTDIR)$(libdir)
#	cp -r src/Ease/ $(DESTDIR)$(libdir)
#	cp -r debian/composer.json $(DESTDIR)$(libdir)
#	mkdir -p $(DESTDIR)$(docdir)
#	cp -r docs $(DESTDIR)$(docdir)
	
#build: doc
#	echo build;	

clean:
	rm -rf vendor composer.lock
	rm -rf debian/php-ease-twbootstrap
	rm -rf debian/php-ease-twbootstrap-doc
	rm -rf debian/*.log debian/tmp
	rm -rf docs/*

apigen:
	VERSION=`cat debian/composer.json | grep version | awk -F'"' '{print $4}'`; \
	apigen generate --source src --destination docs --title "Ease PHP Framework twbootstrap4 ${VERSION}" --charset UTF-8 --access-levels public --access-levels protected --php --tree


composer:
	composer update

phpunit:
	vendor/bin/phpunit --bootstrap tests/Bootstrap.php --configuration phpunit.xml

deb:
	dch -i "`git log -1 --pretty=%B`"
	debuild -i -us -uc -b

rpm:
	rpmdev-bumpspec --comment="`git log -1 --pretty=%B`" --userstring="Vítězslav Dvořák <info@vitexsoftware.cz>" ease-twbootstrap.spec
	rpmbuild -ba ease-twbootstrap.spec

release: fresh deb
	

openbuild:
	

.PHONY : install build
	
