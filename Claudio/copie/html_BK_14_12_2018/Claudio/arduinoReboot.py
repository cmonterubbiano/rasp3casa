import serial
import commands
import subprocess

(status, result) = commands.getstatusoutput('php /var/www/html/Claudio/searcharduinoRead.php')
if  result:
	print "---"+result
else:
        (status, result) = commands.getstatusoutput('/etc/rc.local')
	print "--- NON TROVATO ----"+result
