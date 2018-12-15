import serial
import commands
import subprocess

(status, result) = commands.getstatusoutput('php /var/www/html/Claudio/searchArduinoUSBdevice.php')
lookForRightUsb = '/dev/'+ str(result)
#print "program output:---"+ lookForRightUsb + "---"
ser = serial.Serial(str(lookForRightUsb), 9600)
#ser = serial.Serial('/dev/ttyUSB0', 9600)

while 1:
	signal = ser.readline()
	print "---"+signal
	subprocess.call(['php', '/var/www/html/Claudio/readwriteDb.php', signal])
  