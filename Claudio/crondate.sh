#A=`date +%y%m%d%H%M`
# per scrivere il carattere ` accento grave bisogna digitare ALT 96
# per la ~ ALT 126
A=`date +%Y%m%d%H%M`
B="raspberry|temperatura|"$A
echo $B
# Aggiunto il 12/10/18 il background arduinoRead ogni tanto cadeva
# con il comando seguente se fosse spento viene riattivato controllo ogni 10 m.
/usr/bin/python /var/www/html/Claudio/arduinoReboot.py
#
/usr/bin/python /var/www/html/Claudio/arduinoWrite.py raspberry\|temperatura\|$A


