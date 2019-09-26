
#!/usr/bin/bash

cat $FILENAME.header > $FILENAME.html
cat $FILENAME.txt >> $FILENAME.html
cat $FILENAME.footer >> $FILENAME.html
