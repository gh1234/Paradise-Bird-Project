;<?php die('PDBP'); ?>
[smarty]
real_name = "Smarty Template Engine"
description = "Dieses Paket enthällt die Smarty Template engine, welche php Code von der Ausgabe trennt."
patchnotes[] = "2.6.26; Inial release."
version = "2.6.26"
type = "run"
active = "true"
author = "New Digital Group"
mail = 
license = "lgpl"
website = "http://www.smarty.net/"
depend_runtime[] = "header"
[hello_world]
real_name = "Hallo Welt!"
description = "Dieses Paket gibt Hallo Welt aus."
patchnotes[] = "0.1.0; Release Alpha"
patchnotes[] = "0.1.1; Bug gefixt"
version = "0.1.1"
type = "index"
active = "true"
author = "GH1234"
mail = "jonas.schwabe@gmail.com"
license = "gpl"
website = "http://www.cascaded-web.com"
depend_runtime[] = "header"
depend_runtime[] = "perm"
[adodb]
real_name = "AdoDB"
description = "Datenbank Abstraktionsschicht."
patchnotes[] = "5.0.7; Initial Release"
version = "5.0.7"
type = "run"
active = "true"
author = "John Lim"
mail = "jlim#natsoft.com "
license = "lgpl"
website = "http://adodb.sourceforge.net/"
[backup_loader]
real_name = "Full backup download"
description = "Mit diesem Paket können Backups aus dem geschützten Bereich geladen werden."
patchnotes[] = "0.1.0; Release Alpha"
version = "0.1.0"
type = "index"
active = "true"
author = "GH1234"
mail = "jonas.schwabe@gmail.com"
license = "gpl"
website = "http://www.cascaded-web.com"
depend_runtime[] = "header"
[header]
real_name = "PHP Header Generator"
description = "Mit diesem Paket können HTTP Header gesetzt werden."
patchnotes[] = "0.1.0; Release Alpha"
version = "0.1.0"
type = "run"
active = "true"
author = "GH1234"
mail = "jonas.schwabe@gmail.com"
license = "gpl"
website = "http://www.cascaded-web.com"
[perm]
real_name = "Permission agent"
description = "Mit diesem Paket werden Pakete für verschiedene Personen gesperrt und freigegeben."
patchnotes[] = "0.1.0; Release Alpha"
version = "0.1.0"
type = "run"
active = "true"
author = "GH1234"
mail = "jonas.schwabe@gmail.com"
license = "gpl"
website = "http://www.cascaded-web.com"
depend_runtime[] = "adodb"
depend_runtime[] = "smarty"
depend_runtime[] = "users"
[users]
real_name = "User"
description = "User und Gruppen auswerten"
patchnotes[] = "0.1.0; Release Alpha"
version = "0.0.1"
type = "init"
active = "true"
author = "GH1234"
mail = "jonas.schwabe@gmail.com"
license = "gpl"
website = "http://www.cascaded-web.com"
depend_runtime[] = "adodb"
[users_login]
real_name = "Login"
description = "Administrativer Login"
patchnotes[] = "0.1.0; Release Alpha"
version = "0.0.1"
type = "index"
active = "true"
author = "GH1234"
mail = "jonas.schwabe@gmail.com"
license = "gpl"
website = "http://www.cascaded-web.com"
depend_runtime[] = "adodb"
depend_runtime[] = "smarty"
depend_runtime[] = "users"
[index]
real_name = "Startseite"
description = "Lässt verschiedene Module als Startseite starten"
patchnotes[] = "0.1.0; Release Alpha"
version = "0.0.1"
type = "index"
active = "true"
author = "GH1234"
mail = "jonas.schwabe@gmail.com"
license = "gpl"
website = "http://www.cascaded-web.com"