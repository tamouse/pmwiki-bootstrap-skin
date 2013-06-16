OBJECTS=skin.tmpl skin.php skin.css fonts.css

dist: $(OBJECTS)
	/usr/bin/zip mouse-skin.zip $(OBJECTS) images/* wikilib.d/*
