OBJECTS=.gitignore Makefile README.md bootstrap.css bootstrap.php bootstrap.tmpl images/euphonium.gif images/euphonium.jpg wikilib.d/Site.BootstrapSkin wikilib.d/Site.BootstrapSkin-PageActions wikilib.d/Site.BootstrapSkin-PageTitle wikilib.d/Site.BootstrapSkin-SideBar wikilib.d/Site.BootstrapSkin-SiteFooter wikilib.d/Site.BootstrapSkin-SiteHeader


dist: ../bootstrap-skin.zip

../bootstrap-skin.zip: $(OBJECTS)
	git archive --format zip --prefix bootstrap-skin/ --output-file ../bootstrap-skin.zip HEAD
